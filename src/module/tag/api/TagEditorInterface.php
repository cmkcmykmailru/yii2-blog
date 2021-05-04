<?php

namespace grigor\blog\module\tag\api;

use grigor\blog\module\tag\api\commands\TagCommand;

interface TagEditorInterface
{
    public function edit(TagInterface $tag, TagCommand $dto): void;
}