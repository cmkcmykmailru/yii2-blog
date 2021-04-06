<?php

namespace grigor\blog\module\post;

use grigor\blog\module\post\api\TrashManageServiceInterface;
use grigor\blog\module\post\TrashManageService;
use grigor\library\services\ServiceEventsProxy;

class TrashManageServiceProxy extends ServiceEventsProxy implements TrashManageServiceInterface
{

    public function __construct(
        TrashManageService $realService,
        $config = []
    )
    {
        parent::__construct($realService, $config);
    }

    public function remove(string $id): void
    {
        $this->wrap([$this->realService, 'remove'], ['id' => $id], [
            ServiceEventsProxy::EVENT_BEFORE_METHOD_EXECUTE => 'postRemove',
            ServiceEventsProxy::EVENT_AFTER_METHOD_EXECUTE => 'postRemoved',
            ServiceEventsProxy::EVENT_ERROR_METHOD_EXECUTE => 'postRemoveError',
        ]);
    }

    public function trash(string $id): void
    {
        $this->wrap([$this->realService, 'trash'], ['id' => $id], [
            ServiceEventsProxy::EVENT_BEFORE_METHOD_EXECUTE => 'postTrash',
            ServiceEventsProxy::EVENT_AFTER_METHOD_EXECUTE => 'postTrashed',
            ServiceEventsProxy::EVENT_ERROR_METHOD_EXECUTE => 'postTrashError',
        ]);
    }

    public function restoreFromTrash(string $id): void
    {
        $this->wrap([$this->realService, 'restoreFromTrash'], ['id' => $id], [
            ServiceEventsProxy::EVENT_BEFORE_METHOD_EXECUTE => 'postRestoreFromTrash',
            ServiceEventsProxy::EVENT_AFTER_METHOD_EXECUTE => 'postRestored',
            ServiceEventsProxy::EVENT_ERROR_METHOD_EXECUTE => 'postRestoreFromTrashError',
        ]);
    }
}