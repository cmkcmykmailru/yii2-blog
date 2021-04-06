<?php

namespace grigor\blog\module\tag;

use grigor\blog\module\tag\api\TagInterface;
use grigor\blog\module\tag\api\TagReadRepositoryInterface;
use grigor\blog\module\tag\api\TagResourceModelInterface;
use yii\db\ActiveQueryInterface;

class TagReadRepository implements TagReadRepositoryInterface
{
    public TagResourceModelInterface $resourceModel;

    public function __construct(TagResourceModelInterface $resource)
    {
        $this->resourceModel = $resource;
    }

    public function findBySlug($slug): ?TagInterface
    {
        return $this->getQuery()->andWhere(['slug' => $slug])->limit(1)->one();
    }

    protected function getQuery(): ActiveQueryInterface
    {
        return $this->resourceModel->getQuery();
    }
}