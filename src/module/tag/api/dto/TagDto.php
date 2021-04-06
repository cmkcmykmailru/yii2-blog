<?php

namespace grigor\blog\module\tag\api\dto;

class TagDto
{
    public string $name;
    public string $slug;
    public ?string $id = null;

    /**
     * TagDto constructor.
     * @param string $name
     * @param string $slug
     */
    public function __construct(string $name, string $slug, ?string $id = null)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->id = $id;
    }

}