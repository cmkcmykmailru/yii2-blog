<?php

namespace grigor\blog\module\post;

use grigor\blog\module\post\api\commands\PostCommand;
use grigor\blog\module\post\api\PostFactoryInterface;
use grigor\blog\module\post\api\PostInterface;
use grigor\blog\module\post\api\PostRepositoryInterface;
use grigor\library\exceptions\NotFoundException;
use grigor\library\repositories\strategies\DeleteStrategyInterface;
use grigor\library\repositories\strategies\SaveStrategyInterface;
use yii\db\ActiveQueryInterface;

class PostRepository implements PostRepositoryInterface
{
    /**@var PostFactoryInterface $factory */
    private $factory;
    private $saveStrategy;
    private $deleteStrategy;
    /**
     * PostRepository constructor.
     * @param PostFactoryInterface $factory
     * @param SaveStrategyInterface $saveStrategy
     * @param DeleteStrategyInterface $deleteStrategy
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

    public function createPost(PostCommand $dto): PostInterface
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

    protected function getQuery(): ActiveQueryInterface
    {
        return Post::find();
    }

}