<?php


namespace grigor\blog\module\category\api\dto;


use grigor\library\dto\Meta;

class CategoryDto
{
    public string $name;
    public string $slug;
    public string $title;
    public ?string $description = null;
    public string $parentId;
    public ?string $id = null;
    public Meta $meta;

    /**
     * CategoryDto constructor.
     * @param string $name
     * @param string $slug
     * @param string $title
     * @param string|null $description
     * @param string $parentId
     */
    public function __construct(
        string $name,
        string $slug,
        string $title,
        string $parentId,
        Meta $meta,
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