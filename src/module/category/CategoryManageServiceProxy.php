<?php

namespace grigor\blog\module\category;

use grigor\blog\module\category\api\CategoryInterface;
use grigor\blog\module\category\api\CategoryManageServiceInterface;
use grigor\blog\module\category\api\dto\CategoryDto;
use grigor\library\services\ServiceEventsProxy;

class CategoryManageServiceProxy extends ServiceEventsProxy implements CategoryManageServiceInterface
{

    public function __construct(
        CategoryManageService $realService,
        $config = []
    )
    {
        parent::__construct($realService, $config);
    }

    public function create(CategoryDto $dto): CategoryInterface
    {
        return $this->wrap([$this->realService, 'create'], ['dto' => $dto], [
            ServiceEventsProxy::EVENT_BEFORE_METHOD_EXECUTE => 'categoryCreate',
            ServiceEventsProxy::EVENT_AFTER_METHOD_EXECUTE => 'categoryCreated',
            ServiceEventsProxy::EVENT_ERROR_METHOD_EXECUTE => 'categoryCreateError',
        ]);
    }

    public function edit(CategoryDto $dto): void
    {
        $this->wrap([$this->realService, 'edit'], ['dto' => $dto], [
            ServiceEventsProxy::EVENT_BEFORE_METHOD_EXECUTE => 'categoryEdit',
            ServiceEventsProxy::EVENT_AFTER_METHOD_EXECUTE => 'categoryEdited',
            ServiceEventsProxy::EVENT_ERROR_METHOD_EXECUTE => 'categoryEditError',
        ]);
    }

    public function remove($id): void
    {
        $this->wrap([$this->realService, 'remove'], ['id' => $id], [
            ServiceEventsProxy::EVENT_BEFORE_METHOD_EXECUTE => 'categoryEdit',
            ServiceEventsProxy::EVENT_AFTER_METHOD_EXECUTE => 'categoryEdited',
            ServiceEventsProxy::EVENT_ERROR_METHOD_EXECUTE => 'categoryEditError',
        ]);
    }
}