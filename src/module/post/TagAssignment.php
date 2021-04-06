<?php

namespace grigor\blog\module\post;

use grigor\blog\module\post\api\TagAssignmentInterface;
use yii\db\ActiveRecord;

class TagAssignment extends ActiveRecord implements TagAssignmentInterface
{

    public function isForTag($id): bool
    {
        return $this->tag_id == $id;
    }

    public static function tableName(): string
    {
        return '{{%blog_tag_assignments}}';
    }

    public function create($tagId): TagAssignmentInterface
    {
        $assignment = new self();
        $assignment->tag_id = $tagId;
        return $assignment;
    }
}