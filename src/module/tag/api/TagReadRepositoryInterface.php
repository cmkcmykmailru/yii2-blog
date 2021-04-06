<?php

namespace grigor\blog\module\tag\api;

use grigor\blog\module\tag\api\TagInterface;

interface TagReadRepositoryInterface
{
    public function findBySlug($slug): ?TagInterface;
}