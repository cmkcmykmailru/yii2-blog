<?php

namespace grigor\blog\module\category\api;

use grigor\library\commands\MetaCommand;
use yii\db\ActiveRecordInterface;

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property int $sort
 * @property MetaCommand $meta
 */
interface CategoryInterface extends ActiveRecordInterface
{

    public function getMetaTitle(): string;

    public function getHeading(): string;

}