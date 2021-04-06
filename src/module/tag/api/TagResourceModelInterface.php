<?php

namespace grigor\blog\module\tag\api;

use yii\db\ActiveQueryInterface;

interface TagResourceModelInterface
{
    public function getQuery(): ActiveQueryInterface;
}