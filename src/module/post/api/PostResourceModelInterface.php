<?php

namespace grigor\blog\module\post\api;

use yii\db\ActiveQueryInterface;

interface PostResourceModelInterface
{
    public function getQuery(): ActiveQueryInterface;
}