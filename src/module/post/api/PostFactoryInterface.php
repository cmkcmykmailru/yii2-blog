<?php

namespace grigor\blog\module\post\api;

use grigor\blog\module\post\api\dto\PostDto;

interface PostFactoryInterface
{
    public function create(PostDto $dto): PostInterface;
}