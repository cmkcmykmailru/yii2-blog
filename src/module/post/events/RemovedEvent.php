<?php

namespace grigor\blog\module\post\events;

class RemovedEvent
{
    public array $post;

    /**
     * CreatedEvent constructor.
     * @param $post
     */
    public function __construct(array $post)
    {
        $this->post = $post;
    }
}