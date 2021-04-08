<?php

namespace grigor\blog\module\post;

use grigor\blog\module\post\api\dto\PostDto;
use grigor\blog\module\post\api\PostFactoryInterface;
use grigor\blog\module\post\api\PostInterface;
use grigor\blog\module\post\api\PostRepositoryInterface;
use grigor\blog\module\post\api\PostResourceModelInterface;
use grigor\blog\module\tag\api\TagInterface;
use grigor\library\exceptions\NotFoundException;
use grigor\library\helpers\DefinitionHelper;
use grigor\library\repositories\strategies\DeleteStrategyInterface;
use grigor\library\repositories\strategies\SaveStrategyInterface;
use yii\db\ActiveQuery;

class PostRepository implements PostRepositoryInterface
{
    /**@var PostFactoryInterface $factory */
    private $factory;
    private $saveStrategy;
    private $deleteStrategy;

    /**
     * PostRepository constructor.
     * @param $factory
     */
    public function __construct(
        PostFactoryInterface $factory,
        SaveStrategyInterface $saveStrategy,
        DeleteStrategyInterface $deleteStrategy
    )
    {
        $this->factory = $factory;
        $this->saveStrategy = $saveStrategy;
        $this->deleteStrategy = $deleteStrategy;
    }

    public function createPost(PostDto $dto): PostInterface
    {
        return $this->factory->create($dto);
    }

    public function get($id): PostInterface
    {
        $query = $this->getQuery();
        if (!$post = $query->andWhere(['id' => $id])->limit(1)->one()) {
            throw new NotFoundException('Post is not found.');
        }
        return $post;
    }

    public function existsByCategory($id): bool
    {
        return $this->getQuery()->andWhere(['category_id' => $id])->exists();
    }

    public function save(PostInterface $post): void
    {
        $this->saveStrategy->save($post);
    }

    public function remove(PostInterface $post): void
    {
        $this->deleteStrategy->delete($post);
    }

    private function getQuery(): ActiveQuery
    {
        $postClass = DefinitionHelper::getDefinition(PostInterface::class);
        return $postClass::find();
    }
}