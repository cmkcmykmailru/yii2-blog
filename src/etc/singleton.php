<?php

use grigor\library\factories\LatSlugFactory;
use grigor\library\factories\SlugFactoryInterface;
use grigor\library\repositories\strategies\BaseDeleteStrategy;
use grigor\library\repositories\strategies\BaseSaveStrategy;
use grigor\library\repositories\strategies\DeleteStrategyInterface;
use grigor\library\repositories\strategies\SaveStrategyInterface;

return array_merge(
    require __DIR__ . '/../module/category/etc/singleton.php',
    require __DIR__ . '/../module/post/etc/singleton.php',
    require __DIR__ . '/../module/tag/etc/singleton.php',
    [
        SaveStrategyInterface::class => BaseSaveStrategy::class,
        DeleteStrategyInterface::class => BaseDeleteStrategy::class,
        SlugFactoryInterface::class => LatSlugFactory::class
    ]
);
