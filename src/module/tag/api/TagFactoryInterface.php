<?php

namespace grigor\blog\module\tag\api;

use grigor\blog\module\tag\api\commands\TagCommand;

interface TagFactoryInterface
{
    public function create(TagCommand $dto): TagInterface;
}