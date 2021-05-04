<?php

namespace grigor\blog\module\tag;

use grigor\blog\module\tag\api\commands\TagCommand;
use grigor\blog\module\tag\api\TagEditorInterface;
use grigor\blog\module\tag\api\TagInterface;
use grigor\blog\module\tag\api\TagManageServiceInterface;
use grigor\blog\module\tag\api\TagRepositoryInterface;

class TagManageService implements TagManageServiceInterface
{
    private $tags;
    private $editor;

    public function __construct(
        TagRepositoryInterface $tags,
        TagEditorInterface $editor
    )
    {
        $this->tags = $tags;
        $this->editor = $editor;
    }

    public function create(TagCommand $dto): TagInterface
    {
        $tag = $this->tags->createTag($dto);
        $this->tags->save($tag);
        return $tag;
    }

    public function edit(TagCommand $dto): void
    {
        $tag = $this->tags->get($dto->id);
        $this->editor->edit($tag, $dto);
        $this->tags->save($tag);
    }

    public function remove($id): void
    {
        $tag = $this->tags->get($id);
        $this->tags->remove($tag);
    }

}