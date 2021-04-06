<?php

namespace grigor\blog\module\post;

use grigor\blog\module\post\api\PostResourceModelInterface;
use yii\db\ActiveQueryInterface;

class PostResourceModel implements PostResourceModelInterface
{
    public function getQuery(): ActiveQueryInterface
    {
        return Post::find();
    }
}