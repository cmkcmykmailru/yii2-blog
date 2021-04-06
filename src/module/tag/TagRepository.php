<?php

namespace grigor\blog\module\tag;

use grigor\blog\module\tag\api\dto\TagDto;
use grigor\blog\module\tag\api\TagFactoryInterface;
use grigor\blog\module\tag\api\TagInterface;
use grigor\blog\module\tag\api\TagRepositoryInterface;
use grigor\blog\module\tag\api\TagResourceModelInterface;
use grigor\library\exceptions\NotFoundException;
use grigor\library\repositories\strategies\DeleteStrategyInterface;
use grigor\library\repositories\strategies\SaveStrategyInterface;
use yii\db\ActiveQuery;

class TagRepository implements TagRepositoryInterface
{

    /**@var \grigor\blog\module\tag\api\TagFactoryInterface $factory */
    private $factory;
    private $saveStrategy;
    private $deleteStrategy;
    private $resourceModel;

    /**
     * PostRepository constructor.
     * @param $factory
     */
    public function __construct(
        TagFactoryInterface $factory,
        SaveStrategyInterface $saveStrategy,
        DeleteStrategyInterface $deleteStrategy,
        TagResourceModelInterface $resourceModel
    )
    {
        $this->factory = $factory;
        $this->saveStrategy = $saveStrategy;
        $this->deleteStrategy = $deleteStrategy;
        $this->resourceModel = $resourceModel;
    }

    public function createTag(TagDto $form): TagInterface
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

    private function getQuery(): ActiveQuery
    {
        return $this->resourceModel->getQuery();
    }
}