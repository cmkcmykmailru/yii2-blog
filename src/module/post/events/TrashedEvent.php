<?php

namespace grigor\blog\module\post\events;

class TrashedEvent
{
    public string $postId;

    /**
     * TrashedEvent constructor.
     * @param $postId
     */
    public function __construct(string $postId)
    {
        $this->postId = $postId;
    }
}