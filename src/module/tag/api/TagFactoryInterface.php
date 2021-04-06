<?php

namespace grigor\blog\module\tag\api;

use grigor\blog\module\tag\api\dto\TagDto;

interface TagFactoryInterface
{
    public function create(TagDto $dto): TagInterface;
}