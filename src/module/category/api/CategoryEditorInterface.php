<?php

namespace grigor\blog\module\category\api;

use grigor\blog\module\category\api\dto\CategoryDto;

interface CategoryEditorInterface
{
    public function edit(CategoryInterface $category, CategoryDto $form): void;
}