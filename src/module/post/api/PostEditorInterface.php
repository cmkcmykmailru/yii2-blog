<?php

namespace grigor\blog\module\post\api;

use grigor\blog\module\post\api\dto\PostDto;

interface PostEditorInterface
{
    public function edit(PostInterface $post, PostDto $dto): void;
}