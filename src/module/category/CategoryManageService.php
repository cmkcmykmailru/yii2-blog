<?php

namespace grigor\blog\module\category;

use grigor\blog\module\category\api\CategoryEditorInterface;
use grigor\blog\module\category\api\CategoryInterface;
use grigor\blog\module\category\api\CategoryManageServiceInterface;
use grigor\blog\module\category\api\CategoryRepositoryInterface;
use grigor\blog\module\category\api\commands\CategoryCommand;
use grigor\blog\module\post\api\PostRepositoryInterface;

class CategoryManageService implements CategoryManageServiceInterface
{
    private $categories;
    private $posts;
    private $editor;

    public function __construct(
        CategoryRepositoryInterface $categories,
        PostRepositoryInterface $posts,
        CategoryEditorInterface $editor
    )
    {
        $this->categories = $categories;
        $this->posts = $posts;
        $this->editor = $editor;
    }

    public function create(CategoryCommand $dto): CategoryInterface
    {
        $parent = $this->categories->get($dto->parentId);
        $category = $this->categories->createCategory($dto);
        $category->appendTo($parent);
        $this->categories->save($category);
        return $category;
        return $category;
    }

    public function edit(CategoryCommand $dto): void
    {
        $parent = $this->categories->get($dto->parentId);
        $category = $this->categories->get($dto->id);
        $category->appendTo($parent);
        $this->editor->edit($category,  $dto);
        $this->categories->save($category);
    }

    public function remove($id): void
    {
        $category = $this->categories->get($id);
        if ($this->posts->existsByCategory($category->id)) {
            throw new \DomainException('Unable to remove category with posts.');
        }
        $this->categories->remove($category);
    }
}