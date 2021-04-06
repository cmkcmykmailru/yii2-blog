<?php

namespace grigor\blog\module\category\api;

use yii\db\ActiveQueryInterface;

interface CategoryResourceModelInterface
{
    public function getQuery(): ActiveQueryInterface;
}