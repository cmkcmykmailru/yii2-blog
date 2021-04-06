<?php

namespace grigor\blog\module\category;

use grigor\blog\module\category\api\CategoryEditorInterface;
use grigor\blog\module\category\api\CategoryInterface;
use grigor\blog\module\category\api\dto\CategoryDto;

class CategoryEditor implements CategoryEditorInterface
{
    public function edit(CategoryInterface $category, CategoryDto $dto): void
    {
        $category->name = $dto->name;
        $category->slug = $dto->slug;
        $category->title = $dto->title;
        $category->description = $dto->description;
        $category->meta = $dto->meta;
    }
}