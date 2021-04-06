<?php

namespace grigor\blog\module\post\api;

use grigor\blog\module\post\api\dto\PostDto;
use grigor\library\services\Service;


interface PostManageServiceInterface extends Service
{

    public function create(PostDto $dto): PostInterface;


    public function edit(PostDto $dto): void;


    public function activate(string $id): void;


    public function draft(string $id): void;

}