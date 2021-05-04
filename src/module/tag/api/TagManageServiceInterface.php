<?php

namespace grigor\blog\module\tag\api;

use grigor\blog\module\tag\api\commands\TagCommand;
use grigor\library\services\Service;

interface TagManageServiceInterface extends Service
{
    public function create(TagCommand $form): TagInterface;

    public function edit(TagCommand $form): void;

    public function remove($id): void;
}