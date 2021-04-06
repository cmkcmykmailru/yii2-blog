<?php

namespace grigor\blog\module\post\api;

use Exception;
use grigor\library\services\Service;

interface TrashManageServiceInterface extends Service
{

    public function trash(string $id): void;

    public function restoreFromTrash(string $id): void;

    /**
     * @API\Route(
     *     url="/v1/blog/posts/<id:[\w\-]+>",
     *     methods={"DELETE"},
     *     alias="post/remove"
     * )
     * @API\Response(statusCode="200")
     * @param string $id
     * @throws Exception
     */
    public function remove(string $id): void;
}