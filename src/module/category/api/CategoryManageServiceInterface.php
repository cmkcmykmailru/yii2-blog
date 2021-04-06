<?php

namespace grigor\blog\module\category\api;

use grigor\blog\module\category\api\dto\CategoryDto;
use grigor\library\services\Service;

interface CategoryManageServiceInterface extends Service
{
    public function create(CategoryDto $dto): CategoryInterface;

    public function edit(CategoryDto $dto): void;

    public function remove($id): void;
}