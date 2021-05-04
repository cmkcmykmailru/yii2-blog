<?php

namespace grigor\blog\module\category\api;

use grigor\blog\module\category\api\commands\CategoryCommand;
use grigor\library\services\Service;

interface CategoryManageServiceInterface extends Service
{
    public function create(CategoryCommand $dto): CategoryInterface;

    public function edit(CategoryCommand $dto): void;

    public function remove($id): void;
}