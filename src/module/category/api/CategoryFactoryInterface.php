<?php

namespace grigor\blog\module\category\api;

use grigor\blog\module\category\api\dto\CategoryDto;

interface CategoryFactoryInterface
{
    public function create(CategoryDto $dto): CategoryInterface;
}