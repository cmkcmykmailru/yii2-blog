<?php

namespace grigor\blog\module\tag;

use grigor\blog\module\tag\api\dto\TagDto;
use grigor\blog\module\tag\TagForm;
use grigor\blog\module\tag\api\TagInterface;
use grigor\blog\module\tag\api\TagManageServiceInterface;
use grigor\blog\module\tag\TagManageService;
use grigor\library\services\ServiceEventsProxy;

class TagManageServiceProxy extends ServiceEventsProxy implements TagManageServiceInterface
{

    public function __construct(
        TagManageService $realService,
        $config = []
    )
    {
        $this->realService = $realService;
        parent::__construct($realService, $config);
    }

    public function create(TagDto $dto): TagInterface
    {
        return $this->wrap([$this->realService, 'create'], ['dto' => $dto], [
            ServiceEventsProxy::EVENT_BEFORE_METHOD_EXECUTE => 'tagCreate',
            ServiceEventsProxy::EVENT_AFTER_METHOD_EXECUTE => 'tagCreated',
            ServiceEventsProxy::EVENT_ERROR_METHOD_EXECUTE => 'tagCreateError',
        ]);
    }

    public function edit(TagDto $dto): void
    {
        $this->wrap([$this->realService, 'edit'], [ 'dto' => $dto], [
            ServiceEventsProxy::EVENT_BEFORE_METHOD_EXECUTE => 'tagEdit',
            ServiceEventsProxy::EVENT_AFTER_METHOD_EXECUTE => 'tagEdited',
            ServiceEventsProxy::EVENT_ERROR_METHOD_EXECUTE => 'tagEditError',
        ]);
    }

    public function remove($id): void
    {
        $this->wrap([$this->realService, 'remove'], ['id' => $id], [
            ServiceEventsProxy::EVENT_BEFORE_METHOD_EXECUTE => 'tagRemove',
            ServiceEventsProxy::EVENT_AFTER_METHOD_EXECUTE => 'tagRemoved',
            ServiceEventsProxy::EVENT_ERROR_METHOD_EXECUTE => 'tagRemoveError',
        ]);
    }
}