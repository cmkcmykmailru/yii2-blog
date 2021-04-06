<?php

namespace grigor\blog\module\post;

use grigor\blog\module\post\api\CategoryAssignmentInterface;
use yii\db\ActiveRecord;

/**
 * @property string $post_id;
 * @property string $category_id;
 */
class CategoryAssignment extends ActiveRecord implements CategoryAssignmentInterface
{
    public static function create(string $categoryId): CategoryAssignmentInterface
    {
        $assignment = new self();
        $assignment->category_id = $categoryId;
        return $assignment;
    }

    public function isForCategory($id): bool
    {
        return $this->category_id === $id;
    }

    public static function tableName(): string
    {
        return '{{%blog_category_assignments}}';
    }

}