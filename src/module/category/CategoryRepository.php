<?php

namespace grigor\blog\module\category;

use grigor\blog\module\category\api\CategoryFactoryInterface;
use grigor\blog\module\category\api\CategoryInterface;
use grigor\blog\module\category\api\CategoryRepositoryInterface;
use grigor\blog\module\category\api\commands\CategoryCommand;
use grigor\library\exceptions\NotFoundException;
use grigor\library\repositories\strategies\DeleteStrategyInterface;
use grigor\library\repositories\strategies\SaveStrategyInterface;
use yii\db\ActiveQueryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{

    /**@var CategoryFactoryInterface $factory */
    private $factory;
    private $saveStrategy;
    private $deleteStrategy;

    /**
     * CategoryRepository constructor.
     * @param CategoryFactoryInterface $factory
     * @param SaveStrategyInterface $saveStrategy
     * @param DeleteStrategyInterface $deleteStrategy
     */
    public function __construct(
        CategoryFactoryInterface $factory,
        SaveStrategyInterface $saveStrategy,
        DeleteStrategyInterface $deleteStrategy
    )
    {
        $this->factory = $factory;
        $this->saveStrategy = $saveStrategy;
        $this->deleteStrategy = $deleteStrategy;
    }

    public function createCategory(CategoryCommand $dto): CategoryInterface
    {
        return $this->factory->create($dto);
    }

    public function exist(string $id): bool
    {
        $query = $this->getQuery();
        if (!$category = $query->andWhere(['id' => $id])->limit(1)->one()) {
            return false;
        }
        return true;
    }

    public function get(string $id): CategoryInterface
    {
        $query = $this->getQuery();
        if (!$category = $query->where(['id' => $id])->limit(1)->one()) {
            throw new NotFoundException('Category is not found.');
        }
        return $category;
    }

    public function save(CategoryInterface $category): void
    {
        $this->saveStrategy->save($category);
    }

    public function remove(CategoryInterface $category): void
    {
        $this->deleteStrategy->delete($category);
    }

    private function getQuery(): ActiveQueryInterface
    {
        return Category::find();
    }
}