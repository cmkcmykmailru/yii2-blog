<?php


namespace grigor\blog\module\post\events;


class RestoredFromTrash
{
    public string $postId;

    /**
     * RestoredFromTrash constructor.
     * @param string $postId
     */
    public function __construct(string $postId)
    {
        $this->postId = $postId;
    }

}