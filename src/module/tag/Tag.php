<?php

namespace grigor\blog\module\tag;

use grigor\blog\module\tag\api\TagInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 */
class Tag extends ActiveRecord implements TagInterface
{
    public static function tableName(): string
    {
        return '{{%blog_tags}}';
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class
        ];
    }

}