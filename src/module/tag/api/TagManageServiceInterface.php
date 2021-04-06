<?php

namespace grigor\blog\module\tag\api;

use grigor\blog\module\tag\api\dto\TagDto;
use grigor\library\services\Service;

interface TagManageServiceInterface extends Service
{
    public function create(TagDto $form): TagInterface;

    public function edit(TagDto $form): void;

    public function remove($id): void;
}