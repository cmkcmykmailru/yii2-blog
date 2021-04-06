<?php

namespace grigor\blog\module\category\queries;

use paulzi\nestedsets\NestedSetsQueryTrait;
use yii\db\ActiveQuery;

class CategoryQuery extends ActiveQuery
{
    use NestedSetsQueryTrait;

}