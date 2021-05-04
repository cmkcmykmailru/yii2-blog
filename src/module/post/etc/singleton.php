<?php

use grigor\blog\module\category\api\CategoryRepositoryInterface;
use grigor\blog\module\post\api\PostEditorInterface;
use grigor\blog\module\post\api\PostFactoryInterface;
use grigor\blog\module\post\api\PostManageServiceInterface;
use grigor\blog\module\post\api\PostReadRepositoryInterface;
use grigor\blog\module\post\api\PostRepositoryInterface;
use grigor\blog\module\post\PostEditor;
use grigor\blog\module\post\PostFactory;
use grigor\blog\module\post\PostManageService;
use grigor\blog\module\post\PostManageServiceProxy;
use grigor\blog\module\post\PostReadRepository;
use grigor\blog\module\post\PostRepository;
use grigor\blog\module\tag\api\TagRepositoryInterface;
use grigor\library\factories\LatSlugFactory;
use grigor\library\factories\SlugFactoryInterface;
use grigor\library\repositories\strategies\BaseDeleteStrategy;
use grigor\library\repositories\strategies\BaseSaveStrategy;
use grigor\library\repositories\strategies\DeleteStrategyInterface;
use grigor\library\repositories\strategies\SaveStrategyInterface;
use yii\di\Container;
use yii\di\Instance;

return [
    PostFactoryInterface::class => function (Container $container) {
        return new PostFactory($container);
    },
    PostEditorInterface::class => PostEditor::class,

    PostRepository::class => [
        ['class' => PostRepository::class],
        [
            Instance::of(PostFactoryInterface::class),
            Instance::of(SaveStrategyInterface::class),
            Instance::of(DeleteStrategyInterface::class),
        ]
    ],
    PostRepositoryInterface::class => PostRepository::class,
    PostReadRepositoryInterface::class => PostReadRepository::class,
    PostManageService::class => [
        ['class' => PostManageService::class],
        [
            Instance::of(PostRepositoryInterface::class),
            Instance::of(CategoryRepositoryInterface::class),
            Instance::of(TagRepositoryInterface::class),
            Instance::of(PostEditorInterface::class),
        ]
    ],
    PostManageServiceProxy::class => [
        ['class' => PostManageServiceProxy::class],
        [
            Instance::of(PostManageService::class)
        ]
    ],
    PostManageServiceInterface::class => PostManageServiceProxy::class,

    SaveStrategyInterface::class => BaseSaveStrategy::class,
    DeleteStrategyInterface::class => BaseDeleteStrategy::class,
    SlugFactoryInterface::class => LatSlugFactory::class
];