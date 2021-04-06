<?php

namespace grigor\blog\module\category;

use grigor\blog\module\category\api\CategoryResourceModelInterface;
use yii\db\ActiveQueryInterface;

class CategoryResourceModel implements CategoryResourceModelInterface
{

    public function getQuery(): ActiveQueryInterface
    {
        return Category::find();
    }
}