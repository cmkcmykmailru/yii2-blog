<?php

use grigor\blog\module\post\api\CategoryAssignmentInterface;
use grigor\blog\module\post\api\PostInterface;
use grigor\blog\module\post\api\TagAssignmentInterface;
use grigor\blog\module\post\CategoryAssignment;
use grigor\blog\module\post\Post;
use grigor\blog\module\post\TagAssignment;

return [

    PostInterface::class => Post::class,
    TagAssignmentInterface::class => TagAssignment::class,
    CategoryAssignmentInterface::class => CategoryAssignment::class
];