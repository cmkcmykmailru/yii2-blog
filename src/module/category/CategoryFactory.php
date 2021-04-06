<?php

namespace grigor\blog\module\category;

use grigor\blog\module\category\api\CategoryFactoryInterface;
use grigor\blog\module\category\api\CategoryInterface;
use grigor\blog\module\category\api\dto\CategoryDto;
use Ramsey\Uuid\Uuid;
use yii\di\Container;

class CategoryFactory implements CategoryFactoryInterface
{
    /**@var Container $container */
    private $container;

    /**
     * CategoryFactory constructor.
     * @param $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function create(CategoryDto $dto): CategoryInterface
    {
        $category = $this->container->get(CategoryInterface::class);
        $category->id = Uuid::uuid4()->toString();
        $category->name = $dto->name;
        $category->slug = $dto->slug;
        $category->title = $dto->title;
        $category->description = $dto->description;
        $category->meta = $dto->meta;
        return $category;
    }
}