<?php

namespace grigor\blog\module\category\api;

use grigor\blog\module\category\api\commands\CategoryCommand;

interface CategoryEditorInterface
{
    public function edit(CategoryInterface $category, CategoryCommand $form): void;
}