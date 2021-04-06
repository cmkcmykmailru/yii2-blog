<?php

namespace grigor\blog\module\tag\api;

use grigor\blog\module\tag\api\dto\TagDto;

interface TagRepositoryInterface
{
    public function createTag(TagDto $form): TagInterface;

    public function get($id): TagInterface;

    public function findByName($name): ?TagInterface;

    public function save(TagInterface $tag): void;

    public function remove(TagInterface $tag): void;
}