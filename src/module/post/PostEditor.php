<?php

namespace grigor\blog\module\post;

use grigor\blog\module\post\api\commands\PostCommand;
use grigor\blog\module\post\api\PostEditorInterface;
use grigor\blog\module\post\api\PostInterface;

class PostEditor implements PostEditorInterface
{
    public function edit(PostInterface $post, PostCommand $dto): void
    {
        $post->changeMainCategory($dto->categories->main);
        $post->title = $dto->title;
        $post->description = $dto->description;
        $post->content = $dto->content;
        $post->meta = $dto->meta;
    }
}