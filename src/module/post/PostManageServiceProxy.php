<?php

namespace grigor\blog\module\post;

use grigor\blog\module\post\api\dto\PostDto;
use grigor\blog\module\post\api\PostInterface;
use grigor\blog\module\post\api\PostManageServiceInterface;
use grigor\library\services\ServiceEventsProxy;

class PostManageServiceProxy extends ServiceEventsProxy implements PostManageServiceInterface
{

    public function __construct(
        PostManageService $realService,
        $config = []
    )
    {
        parent::__construct($realService, $config);
    }

    public function create(PostDto $dto): PostInterface
    {
        return $this->wrap([$this->realService, 'create'], ['dto' => $dto], [
            ServiceEventsProxy::EVENT_BEFORE_METHOD_EXECUTE => 'postCreate',
            ServiceEventsProxy::EVENT_AFTER_METHOD_EXECUTE => 'postCreated',
            ServiceEventsProxy::EVENT_ERROR_METHOD_EXECUTE => 'postCreateError',
        ]);
    }

    public function edit(PostDto $dto): void
    {
        $this->wrap([$this->realService, 'edit'], ['dto' => $dto], [
            ServiceEventsProxy::EVENT_BEFORE_METHOD_EXECUTE => 'postEdit',
            ServiceEventsProxy::EVENT_AFTER_METHOD_EXECUTE => 'postEdited',
            ServiceEventsProxy::EVENT_ERROR_METHOD_EXECUTE => 'postEditError',
        ]);
    }

    public function activate(string $id): void
    {
        $this->wrap([$this->realService, 'activate'], ['id' => $id], [
            ServiceEventsProxy::EVENT_BEFORE_METHOD_EXECUTE => 'postActivate',
            ServiceEventsProxy::EVENT_AFTER_METHOD_EXECUTE => 'postActivated',
            ServiceEventsProxy::EVENT_ERROR_METHOD_EXECUTE => 'postActivateError',
        ]);
    }

    public function draft(string $id): void
    {
        $this->wrap([$this->realService, 'draft'], ['id' => $id], [
            ServiceEventsProxy::EVENT_BEFORE_METHOD_EXECUTE => 'postDraft',
            ServiceEventsProxy::EVENT_AFTER_METHOD_EXECUTE => 'postDrafted',
            ServiceEventsProxy::EVENT_ERROR_METHOD_EXECUTE => 'postDraftError',
        ]);
    }

}