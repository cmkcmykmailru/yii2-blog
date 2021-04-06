<?php

namespace grigor\blog\module\post\api\dto;

class TagsDto
{
    public array $tags = [];

    /**
     * TagsDto constructor.
     * @param array $tags
     */
    public function __construct(array $tags = [])
    {
        $this->tags = $tags;
    }

}