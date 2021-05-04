<?php

namespace grigor\blog\module\tag\api\commands;

use grigor\library\commands\Command;

class TagCommand implements Command
{
    public string $name;
    public string $slug;
    public ?string $id = null;

    /**
     * TagDto constructor.
     * @param string $name
     * @param string $slug
     * @param string|null $id
     */
    public function __construct(string $name, string $slug, ?string $id = null)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->id = $id;
    }

}