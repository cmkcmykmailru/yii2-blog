<?php

namespace grigor\blog\module\post\api;

use grigor\library\entity\AggregateRoot;
use yii\db\ActiveRecordInterface;
use yii\web\UploadedFile;

interface PostInterface extends ActiveRecordInterface, AggregateRoot
{
    public const STATUS_DRAFT = 0;
    public const STATUS_ACTIVE = 1;
    public const TRASH = 1;
    public const NOT_TRASH = 0;

    public function setPhoto(UploadedFile $photo): void;

    public function activate(): void;

    public function draft(): void;

    public function isActive(): bool;

    public function isDraft(): bool;

    public function trash(): void;

    public function restoreFromTrash(): void;

    public function isTrash(): bool;

    public function getSeoTitle(): string;

    public function changeMainCategory($categoryId): void;

    public function assignCategory($id): void;

    public function getCategory();

    public function revokeCategories(): void;

    public function revokeCategory($id): void;

    public function assignTag($id): void;

    public function revokeTag($id): void;

    public function revokeTags(): void;

    public function equalsContent($content): bool;
}