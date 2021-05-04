<?php

namespace grigor\blog\module\tag;

use grigor\blog\module\tag\api\commands\TagCommand;
use grigor\blog\module\tag\api\TagFactoryInterface;
use grigor\blog\module\tag\api\TagInterface;
use grigor\blog\module\tag\api\TagRepositoryInterface;
use grigor\library\exceptions\NotFoundException;
use grigor\library\repositories\strategies\DeleteStrategyInterface;
use grigor\library\repositories\strategies\SaveStrategyInterface;
use yii\db\ActiveQueryInterface;

class TagRepository implements TagRepositoryInterface
{

    /**@var TagFactoryInterface $factory */
    private $factory;
    private $saveStrategy;
    private $deleteStrategy;

    /**
     * PostRepository constructor.
     * @param TagFactoryInterface $factory
     * @param SaveStrategyInterface $saveStrategy
     * @param DeleteStrategyInterface $deleteStrategy
     */
    public function __construct(
        TagFactoryInterface $factory,
        SaveStrategyInterface $saveStrategy,
        DeleteStrategyInterface $deleteStrategy
    )
    {
        $this->factory = $factory;
        $this->saveStrategy = $saveStrategy;
        $this->deleteStrategy = $deleteStrategy;
    }

    public function createTag(TagCommand $form): TagInterface
    {
        return $this->factory->create($form);
    }

    public function get($id): TagInterface
    {
        $query = $this->getQuery();
        if (!$tag = $query->andWhere(['id' => $id])->limit(1)->one()) {
            throw new NotFoundException('Tag is not found.');
        }
        return $tag;
    }

    public function findByName($name): ?TagInterface
    {
        return $this->getQuery()->andWhere(['name' => $name])->one();
    }

    public function save(TagInterface $tag): void
    {
        $this->saveStrategy->save($tag);
    }

    public function remove(TagInterface $tag): void
    {
        $this->deleteStrategy->delete($tag);
    }

    private function getQuery(): ActiveQueryInterface
    {
        return Tag::find();
    }

}