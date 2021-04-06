<?php

namespace grigor\blog\module\tag;

use grigor\blog\module\tag\api\dto\TagDto;
use grigor\blog\module\tag\api\TagEditorInterface;
use grigor\blog\module\tag\api\TagInterface;

class TagEditor implements TagEditorInterface
{

    public function edit(TagInterface $tag, TagDto $dto): void
    {
        $tag->name = empty($dto->name) ? $tag->name : $dto->name;
        $tag->slug = empty($dto->slug) ? $tag->slug : $dto->slug;
    }

}