<?php

namespace grigor\blog\module\post\api\commands;

use grigor\library\commands\Command;
use grigor\library\commands\MetaCommand;

class PostCommand implements Command
{
    public ?string $id = null;
    public ?string $title = null;
    public ?string $description = null;
    public ?string $content = null;

    public CategoriesCommand $categories;
    public MetaCommand $meta;
    public TagsCommand $tags;

    /**
     * PostDto constructor.
     * @param string|null $id
     * @param string $title
     * @param string $content
     * @param string|null $description
     * @param CategoriesCommand $categories
     * @param MetaCommand $meta
     * @param TagsCommand $tags
     */
    public function __construct(
        string $title,
        string $content,
        CategoriesCommand $categories,
        MetaCommand $meta,
        TagsCommand $tags,
        ?string $id = null,
        ?string $description = null
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->categories = $categories;
        $this->meta = $meta;
        $this->tags = $tags;
    }

}