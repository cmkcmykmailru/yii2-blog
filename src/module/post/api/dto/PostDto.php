<?php

namespace grigor\blog\module\post\api\dto;

use grigor\library\dto\Meta;

class PostDto
{
    public ?string $id = null;
    public ?string $title = null;
    public ?string $description = null;
    public ?string $content = null;

    public CategoriesDto $categories;
    public Meta $meta;
    public TagsDto $tags;

    /**
     * PostDto constructor.
     * @param string|null $id
     * @param string $title
     * @param string $content
     * @param string|null $description
     * @param CategoriesDto $categories
     * @param Meta $meta
     * @param TagsDto $tags
     */
    public function __construct(
        string $title,
        string $content,
        CategoriesDto $categories,
        Meta $meta,
        TagsDto $tags,
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