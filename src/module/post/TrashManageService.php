<?php

namespace grigor\blog\module\post;

use grigor\blog\module\post\api\PostRepositoryInterface;
use grigor\blog\module\post\api\TrashManageServiceInterface;

class TrashManageService implements TrashManageServiceInterface
{
    private $posts;

    public function __construct(PostRepositoryInterface $posts)
    {
        $this->posts = $posts;
    }

    public function remove(string $id): void
    {
        $post = $this->posts->get($id);
        $this->posts->remove($post);
    }

    public function trash(string $id): void
    {
        $post = $this->posts->get($id);
        $post->trash();
        $this->posts->save($post);
    }

    public function restoreFromTrash(string $id): void
    {
        $post = $this->posts->get($id);
        $post->restoreFromTrash();
        $this->posts->save($post);
    }
}