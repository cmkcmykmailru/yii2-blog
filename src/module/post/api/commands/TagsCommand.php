<?php

namespace grigor\blog\module\post\api\commands;

use grigor\library\commands\Command;

class TagsCommand implements Command
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