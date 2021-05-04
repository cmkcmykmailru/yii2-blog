<?php

namespace grigor\blog\module\tag;

use grigor\blog\module\tag\api\commands\TagCommand;
use grigor\blog\module\tag\api\TagFactoryInterface;
use grigor\blog\module\tag\api\TagInterface;
use Ramsey\Uuid\Uuid;
use yii\di\Container;

class TagFactory implements TagFactoryInterface
{
    /**@var Container $container */
    private $container;

    /**
     * TagFactory constructor.
     * @param $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function create(TagCommand $dto): TagInterface
    {
        $tag = $this->container->get(TagInterface::class);
        $tag->id = Uuid::uuid4()->toString();
        $tag->name = $dto->name;
        $tag->slug = $dto->slug;
        return $tag;
    }
}