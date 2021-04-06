<?php

namespace grigor\blog\module\post\events;

class CreatedEvent
{
    public string $postId;

    /**
     * CreatedEvent constructor.
     * @param $postId
     */
    public function __construct(string $postId)
    {
        $this->postId = $postId;
    }
}