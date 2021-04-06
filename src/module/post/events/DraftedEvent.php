<?php

namespace grigor\blog\module\post\events;

class DraftedEvent
{
    public string $postId;

    /**
     * DraftEvent constructor.
     * @param $postId
     */
    public function __construct(string $postId)
    {
        $this->postId = $postId;
    }

}