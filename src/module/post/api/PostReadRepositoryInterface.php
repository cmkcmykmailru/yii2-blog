<?php

namespace grigor\blog\module\post\api;

use yii\data\DataProviderInterface;

interface PostReadRepositoryInterface
{
    public function count(): int;

    public function getAllByRange($offset, $limit): array;

    public function getAll(): DataProviderInterface;

    public function getAllByCategory(string $id): DataProviderInterface;

    public function getAllByTag(string $id): DataProviderInterface;

    public function getLast($limit): array;

    public function getPopular($limit): array;

    public function find(string $id): ?PostInterface;
}