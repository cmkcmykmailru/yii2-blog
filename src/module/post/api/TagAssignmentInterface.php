<?php

namespace grigor\blog\module\post\api;

use yii\db\ActiveRecordInterface;

interface TagAssignmentInterface extends ActiveRecordInterface
{
    public function create($tagId): TagAssignmentInterface;

    public function isForTag($id): bool;
}