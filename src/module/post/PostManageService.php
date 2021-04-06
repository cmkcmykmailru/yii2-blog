<?php

namespace grigor\blog\module\post;

use grigor\blog\module\category\api\CategoryRepositoryInterface;
use grigor\blog\module\post\api\dto\PostDto;
use grigor\blog\module\post\api\PostManageServiceInterface;
use grigor\blog\module\tag\api\dto\TagDto;
use grigor\blog\module\post\api\PostEditorInterface;
use grigor\blog\module\post\api\PostInterface;
use grigor\blog\module\post\api\PostRepositoryInterface;
use grigor\blog\module\tag\api\TagRepositoryInterface;
use grigor\library\exceptions\NotFoundException;
use grigor\library\factories\SlugFactoryInterface;

class PostManageService implements PostManageServiceInterface
{
    private $posts;
    private $categories;
    private $tags;
    private $editor;
    private $slugFactory;

    public function __construct(
        PostRepositoryInterface $posts,
        CategoryRepositoryInterface $categories,
        TagRepositoryInterface $tags,
        PostEditorInterface $editor,
        SlugFactoryInterface $slugFactory
    )
    {
        $this->posts = $posts;
        $this->categories = $categories;
        $this->tags = $tags;
        $this->editor = $editor;
        $this->slugFactory = $slugFactory;
    }

    /**
     * @param PostDto $dto
     * @return PostInterface
     */
    public function create(PostDto $dto): PostInterface
    {

        if (!$this->categories->exist($dto->categories->main)) {
            throw new \DomainException('Category not found.');
        }

        $post = $this->posts->createPost($dto);

        foreach ($dto->categories->others as $otherId) {
            $category = $this->categories->get($otherId);
            $post->assignCategory($category->id);
        }

        foreach ($dto->tags->tags as $tagName) {
            if (!$tag = $this->tags->findByName($tagName)) {
                $tagDto = new TagDto($tagName, $this->slugFactory->toSlug($tagName));
                $tag = $this->tags->createTag($tagDto);
                $this->tags->save($tag);
            }
            $post->assignTag($tag->id);
        }

        $this->posts->save($post);

        return $post;
    }

    public function edit(PostDto $dto): void
    {
        $id = $dto->id;
        $post = $this->posts->get($id);

        if (!$this->categories->exist($dto->categories->main)) {
            throw new NotFoundException('Category not found.');
        }

        $this->editor->edit($post, $dto);

        $post->revokeCategories();
        $post->revokeTags();
        $this->posts->save($post);

        foreach ($dto->categories->others as $otherId) {
            $category = $this->categories->get($otherId);
            $post->assignCategory($category->id);
        }

        foreach ($dto->tags->tags as $tagName) {
            if (!$tag = $this->tags->findByName($tagName)) {
                $tag = $this->tags->createTag(new TagDto($tagName, $this->slugFactory->toSlug($tagName)));
                $this->tags->save($tag);
            }
            $post->assignTag($tag->id);
        }

        $this->posts->save($post);
    }

    public function activate(string $id): void
    {
        $post = $this->posts->get($id);
        $post->activate();
        $this->posts->save($post);
    }

    public function draft(string $id): void
    {
        $post = $this->posts->get($id);
        $post->draft();
        $this->posts->save($post);
    }

}