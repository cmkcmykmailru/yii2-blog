<?php

namespace grigor\blog\module\post\queries;

use grigor\blog\module\post\api\PostInterface;
use yii\db\ActiveQuery;
use yii\db\QueryInterface;

class PostQuery extends ActiveQuery
{
    /**
     * @param null $alias
     * @return $this
     */
    public function active($alias = null): QueryInterface
    {
        return $this->andWhere([
            ($alias ? $alias . '.' : '') . 'status' => PostInterface::STATUS_ACTIVE,
        ])->andWhere([
            ($alias ? $alias . '.' : '') . 'trash' => PostInterface::NOT_TRASH,
        ]);
    }
}