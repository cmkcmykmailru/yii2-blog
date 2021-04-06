<?php

namespace grigor\blog\module\post\events;

class ActivatedEvent
{
    public string $postId;

    /**
     * ActivatedEvent constructor.
     * @param $postId
     */
    public function __construct(string $postId)
    {
        $this->postId = $postId;
    }
}