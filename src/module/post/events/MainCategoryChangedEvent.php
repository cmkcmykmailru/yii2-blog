<?php

namespace grigor\blog\module\post\events;

class MainCategoryChangedEvent
{
    public string $oldCategoryId;
    public string $newCategoryId;
    public string $postId;

    /**
     * MainCategoryChangedEvent constructor.
     * @param string $oldCategoryId
     * @param string $newCategoryId
     * @param string $postId
     */
    public function __construct(string $oldCategoryId, string $newCategoryId, string $postId)
    {
        $this->oldCategoryId = $oldCategoryId;
        $this->newCategoryId = $newCategoryId;
        $this->postId = $postId;
    }

}