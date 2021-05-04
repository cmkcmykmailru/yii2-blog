<?php

namespace grigor\blog\module\post;

use grigor\blog\module\post\api\commands\PostCommand;
use grigor\blog\module\post\api\PostFactoryInterface;
use grigor\blog\module\post\api\PostInterface;
use grigor\blog\module\post\events\CreatedEvent;
use Ramsey\Uuid\Uuid;
use yii\di\Container;

class PostFactory implements PostFactoryInterface
{
    /**@var Container $container */
    private $container;

    /**
     * PostFactory constructor.
     * @param $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function create(PostCommand $dto): PostInterface
    {
        $post = $this->container->get(PostInterface::class);
        $post->id = Uuid::uuid4()->toString();
        $post->category_id = $dto->categories->main;
        $post->title = $dto->title;
        $post->description = $dto->description;
        $post->content = $dto->content;
        $post->meta = $dto->meta;
        $post->status = PostInterface::STATUS_DRAFT;
        $post->recordEvent(new CreatedEvent($post->id));
        return $post;
    }
}