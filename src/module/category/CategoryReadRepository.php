<?php

namespace grigor\blog\module\category;

use grigor\blog\module\category\api\CategoryInterface;
use grigor\blog\module\category\api\CategoryReadRepositoryInterface;
use grigor\library\contexts\Inflator;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQueryInterface;
use yii\helpers\ArrayHelper;

class CategoryReadRepository implements CategoryReadRepositoryInterface
{

    public function findAll(): DataProviderInterface
    {
        $query = $this->getQuery()->andWhere(['<>', 'slug', 'root'])->orderBy('lft');
        return $this->getProvider($query);
    }

    public function getAll(): array
    {
        return $this->getQuery()->andWhere(['<>', 'slug', 'root'])->orderBy('lft')->all();
    }

    public function find($id): ?CategoryInterface
    {
        return $this->getQuery()->andWhere(['id' => $id])->one();
    }

    public function findBySlug($slug): ?CategoryInterface
    {
        return $this->getQuery()->andWhere(['slug' => $slug])->one();
    }

    public function getAvailableCategories(bool $root = false, string $defaultName = '', ?CategoryInterface $category = null): array
    {
        if ($category) {
            $descendants = $category->descendants;
            $ids = ArrayHelper::getColumn($descendants, 'id');
            $ids[] = $category->id;

            $query = $this->getQuery()->andWhere(['not', ['in', 'id', $ids]]);

            if (!$root) {
                $query->andWhere(['<>', 'slug', 'root']);
            }

            $categories = $query->orderBy('lft')->asArray()->all();

            return ArrayHelper::map($categories, 'id', function (array $category) use ($defaultName) {
                return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . (empty($category['name']) ? $defaultName : $category['name']);
            });
        }

        $query = $this->getQuery();

        if (!$root) {
            $query->andWhere(['<>', 'slug', 'root']);
        }

        $categories = $query->orderBy('lft')->asArray()->all();

        return ArrayHelper::map($categories, 'id', function (array $category) use ($defaultName) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '') . (empty($category['name']) ? $defaultName : $category['name']);
        });
    }

    protected function getQuery(): ActiveQueryInterface
    {
        return Category::find();
    }

    private function getProvider(ActiveQueryInterface $query): DataProviderInterface
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);
    }

}