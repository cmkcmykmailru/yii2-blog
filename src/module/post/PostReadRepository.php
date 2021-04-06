<?php

namespace grigor\blog\module\post;

use grigor\blog\module\post\api\PostInterface;
use grigor\blog\module\post\api\PostReadRepositoryInterface;
use grigor\blog\module\post\api\PostResourceModelInterface;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;
use yii\db\ActiveQueryInterface;

class PostReadRepository implements PostReadRepositoryInterface
{
    public PostResourceModelInterface $resourceModel;

    public function __construct(PostResourceModelInterface $resource)
    {
        $this->resourceModel = $resource;
    }

    public function count(): int
    {
        return $this->getQuery()->active()->count();
    }

    public function getAllByRange($offset, $limit): array
    {
        return $this->getQuery()->active()->orderBy(['id' => SORT_ASC])->limit($limit)->offset($offset)->all();
    }

    public function getAll(): DataProviderInterface
    {
        $query = $this->getQuery()->active()->with('category');
        return $this->getProvider($query);
    }

    public function getAllByCategory(string $id): DataProviderInterface
    {
        $query = $this->getQuery()->active()->andWhere(['category_id' => $id])->with('category');
        return $this->getProvider($query);
    }

    public function getAllByTag(string $id): DataProviderInterface
    {
        $query = $this->getQuery()->alias('p')->active('p')->with('category');
        $query->joinWith(['tagAssignments ta'], false);
        $query->andWhere(['ta.tag_id' => $id]);
        $query->groupBy('p.id');
        return $this->getProvider($query);
    }

    public function getLast($limit): array
    {
        return $this->getQuery()->with('category')->orderBy(['id' => SORT_DESC])->limit($limit)->all();
    }

    public function getPopular($limit): array
    {
        return $this->getQuery()->with('category')->orderBy(['comments_count' => SORT_DESC])->limit($limit)->all();
    }

    public function find(string $id): ?PostInterface
    {
        return $this->getQuery()->active()->andWhere(['id' => $id])->one();
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);
    }

    protected function getQuery(): ActiveQueryInterface
    {
        return $this->resourceModel->getQuery();
    }
}