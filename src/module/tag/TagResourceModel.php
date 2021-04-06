<?php

namespace grigor\blog\module\tag;

use grigor\blog\module\tag\api\TagResourceModelInterface;
use yii\db\ActiveQueryInterface;

class TagResourceModel implements TagResourceModelInterface
{

    public function getQuery(): ActiveQueryInterface
    {
        return Tag::find();
    }

}