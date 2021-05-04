<?php

namespace grigor\blog\module\post\api;

use grigor\blog\module\post\api\commands\PostCommand;

interface PostFactoryInterface
{
    public function create(PostCommand $dto): PostInterface;
}