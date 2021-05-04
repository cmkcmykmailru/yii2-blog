<?php

use grigor\blog\module\tag\api\TagEditorInterface;
use grigor\blog\module\tag\api\TagFactoryInterface;
use grigor\blog\module\tag\api\TagManageServiceInterface;
use grigor\blog\module\tag\api\TagReadRepositoryInterface;
use grigor\blog\module\tag\api\TagRepositoryInterface;
use grigor\blog\module\tag\TagEditor;
use grigor\blog\module\tag\TagFactory;
use grigor\blog\module\tag\TagManageService;
use grigor\blog\module\tag\TagManageServiceProxy;
use grigor\blog\module\tag\TagReadRepository;
use grigor\blog\module\tag\TagRepository;
use grigor\library\repositories\strategies\BaseDeleteStrategy;
use grigor\library\repositories\strategies\BaseSaveStrategy;
use grigor\library\repositories\strategies\DeleteStrategyInterface;
use grigor\library\repositories\strategies\SaveStrategyInterface;
use yii\di\Container;
use yii\di\Instance;

return [
    TagEditorInterface::class => TagEditor::class,
    TagFactoryInterface::class => function (Container $container) {
        return new TagFactory($container);
    },
    TagReadRepositoryInterface::class => TagReadRepository::class,
    TagRepository::class => [
        ['class' => TagRepository::class],
        [
            Instance::of(TagFactoryInterface::class),
            Instance::of(SaveStrategyInterface::class),
            Instance::of(DeleteStrategyInterface::class),
        ]
    ],
    TagRepositoryInterface::class => TagRepository::class,
    TagManageService::class => [
        ['class' => TagManageService::class],
        [
            Instance::of(TagRepositoryInterface::class),
            Instance::of(TagEditorInterface::class)
        ]
    ],
    TagManageServiceProxy::class => [
        ['class' => TagManageServiceProxy::class],
        [
            Instance::of(TagManageService::class)
        ]
    ],
    TagManageServiceInterface::class => TagManageServiceProxy::class,
    SaveStrategyInterface::class => BaseSaveStrategy::class,
    DeleteStrategyInterface::class => BaseDeleteStrategy::class,
];