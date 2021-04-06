<?php

namespace grigor\blog\module\post\api;

use grigor\blog\module\post\api\dto\PostDto;

interface PostRepositoryInterface
{
    public function createPost(PostDto $dto): PostInterface;

    public function get($id): PostInterface;

    public function existsByCategory($id): bool;

    public function save(PostInterface $post): void;

    public function remove(PostInterface $post): void;
}