<?php

namespace grigor\blog\module\tag\api;

use grigor\blog\module\tag\api\dto\TagDto;

interface TagEditorInterface
{
    public function edit(TagInterface $tag, TagDto $dto): void;
}