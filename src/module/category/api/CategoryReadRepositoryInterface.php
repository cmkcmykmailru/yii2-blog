<?php

namespace grigor\blog\module\category\api;

use yii\data\DataProviderInterface;

interface CategoryReadRepositoryInterface
{
    public function findAll(): DataProviderInterface;

    public function getAll(): array;

    public function find($id): ?CategoryInterface;

    public function findBySlug($slug): ?CategoryInterface;

    public function getAvailableCategories(bool $root = false, string $defaultName = '', ?CategoryInterface $category = null): array;
}