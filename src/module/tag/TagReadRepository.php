<?php

namespace grigor\blog\module\tag;

use grigor\blog\module\tag\api\TagInterface;
use grigor\blog\module\tag\api\TagReadRepositoryInterface;
use grigor\library\contexts\Inflator;
use yii\db\ActiveQueryInterface;

class TagReadRepository implements TagReadRepositoryInterface
{
    private $inflator;

    /**
     * TagReadRepository constructor.
     */
    public function __construct()
    {
        $this->inflator = Inflator::getInstance();
    }

    public function findBySlug($slug): ?TagInterface
    {
        return $this->getQuery()->andWhere(['slug' => $slug])->limit(1)->one();
    }

    protected function getQuery(): ActiveQueryInterface
    {
        $tagClass = $this->inflator->get(TagInterface::class);
        return $tagClass::find();
    }
}