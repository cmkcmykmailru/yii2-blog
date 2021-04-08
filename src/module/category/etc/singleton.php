<?php

use grigor\blog\module\category\api\CategoryEditorInterface;
use grigor\blog\module\category\api\CategoryFactoryInterface;
use grigor\blog\module\category\api\CategoryManageServiceInterface;
use grigor\blog\module\category\api\CategoryReadRepositoryInterface;
use grigor\blog\module\category\api\CategoryRepositoryInterface;
use grigor\blog\module\category\CategoryEditor;
use grigor\blog\module\category\CategoryFactory;
use grigor\blog\module\category\CategoryManageService;
use grigor\blog\module\category\CategoryManageServiceProxy;
use grigor\blog\module\category\CategoryReadRepository;
use grigor\blog\module\category\CategoryRepository;
use grigor\blog\module\post\api\PostRepositoryInterface;
use grigor\library\repositories\strategies\DeleteStrategyInterface;
use grigor\library\repositories\strategies\SaveStrategyInterface;
use yii\di\Container;
use yii\di\Instance;

return [
    CategoryEditorInterface::class => CategoryEditor::class,
    CategoryFactoryInterface::class => function (Container $container) {
        return new CategoryFactory($container);
    },
    CategoryRepository::class => [
        ['class' => CategoryRepository::class],
        [
            Instance::of(CategoryFactoryInterface::class),
            Instance::of(SaveStrategyInterface::class),
            Instance::of(DeleteStrategyInterface::class),
        ]
    ],
    CategoryReadRepositoryInterface::class => CategoryReadRepository::class,
    CategoryRepositoryInterface::class => CategoryRepository::class,
    CategoryManageService::class => [
        ['class' => CategoryManageService::class],
        [
            Instance::of(CategoryRepositoryInterface::class),
            Instance::of(PostRepositoryInterface::class),
            Instance::of(CategoryEditorInterface::class)
        ]
    ],
    CategoryManageServiceProxy::class => [
        ['class' => CategoryManageServiceProxy::class],
        [Instance::of(CategoryManageService::class)]
    ],
    CategoryManageServiceInterface::class => CategoryManageServiceProxy::class
];