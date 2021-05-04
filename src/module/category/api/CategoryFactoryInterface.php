<?php

namespace grigor\blog\module\category\api;

use grigor\blog\module\category\api\commands\CategoryCommand;

interface CategoryFactoryInterface
{
    public function create(CategoryCommand $dto): CategoryInterface;
}