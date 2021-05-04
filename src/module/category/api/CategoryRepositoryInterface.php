<?php

namespace grigor\blog\module\category\api;

use grigor\blog\module\category\api\commands\CategoryCommand;

interface CategoryRepositoryInterface
{
    public function createCategory(CategoryCommand $form): CategoryInterface;

    public function get(string $id): CategoryInterface;

    public function exist(string $id): bool;

    public function save(CategoryInterface $category): void;

    public function remove(CategoryInterface $category): void;
}