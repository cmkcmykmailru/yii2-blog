<?php

namespace grigor\blog\module\tag;

use grigor\blog\module\tag\api\TagInterface;
use grigor\blog\module\tag\api\TagReadRepositoryInterface;
use grigor\library\helpers\DefinitionHelper;
use yii\db\ActiveQueryInterface;

class TagReadRepository implements TagReadRepositoryInterface
{
    public function findBySlug($slug): ?TagInterface
    {
        return $this->getQuery()->andWhere(['slug' => $slug])->limit(1)->one();
    }

    protected function getQuery(): ActiveQueryInterface
    {
        $tagClass = DefinitionHelper::getDefinition(TagInterface::class);
        return $tagClass::find();
    }
}