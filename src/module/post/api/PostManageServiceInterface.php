<?php

namespace grigor\blog\module\post\api;

use grigor\blog\module\post\api\commands\PostCommand;
use grigor\library\services\Service;

interface PostManageServiceInterface extends Service
{

    public function create(PostCommand $dto): PostInterface;

    public function edit(PostCommand $dto): void;

    public function activate(string $id): void;

    public function draft(string $id): void;

}