<?php

namespace grigor\blog\module\post;

use grigor\blog\module\category\api\CategoryInterface;
use grigor\blog\module\category\Category;
use grigor\blog\module\post\api\PostInterface;
use grigor\blog\module\post\events\ActivatedEvent;
use grigor\blog\module\post\events\DraftedEvent;
use grigor\blog\module\post\events\MainCategoryChangedEvent;
use grigor\blog\module\post\events\RestoredFromTrash;
use grigor\blog\module\post\events\TrashedEvent;
use grigor\blog\module\post\queries\PostQuery;
use grigor\blog\module\tag\api\TagInterface;
use grigor\blog\module\tag\Tag;
use grigor\library\behaviors\MetaBehavior;
use grigor\library\commands\MetaCommand;
use grigor\library\contexts\AbstractEntity;
use grigor\library\entity\EventTrait;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\web\UploadedFile;


/**
 * @property string $id
 * @property integer $category_id
 * @property integer $created_at
 * @property string $title
 * @property string $description
 * @property string $content
 * @property integer $status
 * @property integer $comments_count
 * @property integer $trash
 * @property string $meta_json
 *
 * @property MetaCommand $meta
 * @property CategoryInterface $category
 * @property CategoryInterface[] $categories
 * @property TagInterface[] $tags
 *
 */
class Post extends AbstractEntity implements PostInterface
{

    public $meta;
    use EventTrait;

    public function setPhoto(UploadedFile $photo): void
    {
        $this->photo = $photo;
    }

    public function activate(): void
    {
        if ($this->isActive()) {
            throw new \DomainException('Post is already active.');
        }
        $this->status = self::STATUS_ACTIVE;
        $this->recordEvent(new ActivatedEvent($this->id));
    }

    public function draft(): void
    {
        if ($this->isDraft()) {
            throw new \DomainException('Post is already draft.');
        }
        $this->status = self::STATUS_DRAFT;
        $this->recordEvent(new DraftedEvent($this->id));
    }

    public function isActive(): bool
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function isDraft(): bool
    {
        return $this->status == self::STATUS_DRAFT;
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->title;
    }

    public function changeMainCategory($categoryId): void
    {
        if ($this->category_id === $categoryId) {
            return;
        }
        $old = $this->category_id;
        $this->category_id = $categoryId;

        $this->recordEvent(new MainCategoryChangedEvent($old, $categoryId, $this->id));
    }

    public function assignCategory($id): void
    {
        $assignments = $this->categoryAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForCategory($id)) {
                return;
            }
        }
        $assignments[] = CategoryAssignment::create($id);
        $this->categoryAssignments = $assignments;
    }

    public function revokeCategory($id): void
    {
        $assignments = $this->categoryAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForCategory($id)) {
                unset($assignments[$i]);
                $this->categoryAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not found.');
    }

    public function revokeCategories(): void
    {
        $this->categoryAssignments = [];
    }

    public function assignTag($id): void
    {
        $assignments = $this->tagAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForTag($id)) {
                return;
            }
        }
        $assignments[] = TagAssignment::create($id);
        $this->tagAssignments = $assignments;
    }

    public function revokeTag($id): void
    {
        $assignments = $this->tagAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForTag($id)) {
                unset($assignments[$i]);
                $this->tagAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not found.');
    }

    public function revokeTags(): void
    {
        $this->tagAssignments = [];
    }

    public static function tableName(): string
    {
        return '{{%blog_posts}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
            TimestampBehavior::class,
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['categoryAssignments', 'tagAssignments'],
            ],
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find(): ActiveQuery
    {
        return new PostQuery(static::class);
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getCategoryAssignments(): ActiveQuery
    {
        return $this->hasMany(CategoryAssignment::class, ['post_id' => 'id']);
    }

    public function getCategories(): ActiveQuery
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])->via('categoryAssignments');
    }

    public function getTagAssignments(): ActiveQuery
    {
        return $this->hasMany(TagAssignment::class, ['post_id' => 'id']);
    }

    public function getTags(): ActiveQuery
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])->via('tagAssignments');
    }

    public function equalsContent($content): bool
    {
        return $this->content === $content;
    }

    public function trash(): void
    {
        $this->trash = PostInterface::TRASH;
        $this->recordEvent(new TrashedEvent($this->id));
    }

    public function restoreFromTrash(): void
    {
        $this->trash = PostInterface::NOT_TRASH;
        $this->recordEvent(new RestoredFromTrash($this->id));
    }

    public function isTrash(): bool
    {
        return $this->trash === PostInterface::TRASH;
    }

}