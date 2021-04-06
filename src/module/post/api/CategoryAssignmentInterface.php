<?php

namespace grigor\blog\module\post\api;

use yii\db\ActiveRecordInterface;

interface CategoryAssignmentInterface extends ActiveRecordInterface
{
    public static function create(string $categoryId): CategoryAssignmentInterface;

    public function isForCategory(string $id): bool;
}