<?php

namespace grigor\blog\module\category;

use grigor\blog\module\category\api\CategoryInterface;
use grigor\blog\module\category\queries\CategoryQuery;
use grigor\library\behaviors\MetaBehavior;
use grigor\library\commands\MetaCommand;
use grigor\library\entity\EventTrait;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use paulzi\nestedsets\NestedSetsBehavior;

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property MetaCommand $meta
 */
class Category extends ActiveRecord implements CategoryInterface
{
    public $meta;
    use EventTrait;

    public function getMetaTitle(): string
    {
        return $this->meta->title ?: $this->getHeading();
    }

    public function getHeading(): string
    {
        return $this->title ?: $this->name;
    }

    public static function tableName(): string
    {
        return '{{%blog_categories}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
            NestedSetsBehavior::class,
            TimestampBehavior::class
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find(): CategoryQuery
    {
        return new CategoryQuery(get_called_class());
    }

}