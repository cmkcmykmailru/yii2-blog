<?php

namespace grigor\blog\module\post\api;

use grigor\blog\module\post\api\commands\PostCommand;

interface PostEditorInterface
{
    public function edit(PostInterface $post, PostCommand $dto): void;
}