<?php

namespace grigor\blog\module\category\api\commands;

use grigor\library\commands\Command;
use grigor\library\commands\MetaCommand;

class CategoryCommand implements Command
{
    public string $name;
    public string $slug;
    public string $title;
    public ?string $description = null;
    public string $parentId;
    public ?string $id = null;
    public MetaCommand $meta;

    /**
     * CategoryDto constructor.
     * @param string $name
     * @param string $slug
     * @param string $title
     * @param string $parentId
     * @param MetaCommand $meta
     * @param string|null $id
     * @param string|null $description
     */
    public function __construct(
        string $name,
        string $slug,
        string $title,
        string $parentId,
        MetaCommand $meta,
        ?string $id = null,
        ?string $description = null
    )
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->parentId = $parentId;
        $this->id = $id;
        $this->meta = $meta;
    }

}