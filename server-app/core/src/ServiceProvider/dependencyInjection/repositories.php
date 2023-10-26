<?php
declare(strict_types=1);

return [
    CoreKanban\Domain\Contracts\Repositories\LabelRepositoryInterface::class => CoreKanban\Infrastructure\DataAccess\Repositories\Label\LabelRepository::class,

    CoreKanban\Domain\Contracts\Repositories\TaskListRepositoryInterface::class => CoreKanban\Infrastructure\DataAccess\Repositories\TaskList\TaskListRepository::class,

    CoreKanban\Domain\Contracts\Repositories\UserRepositoryInterface::class => CoreKanban\Infrastructure\DataAccess\Repositories\User\UserRepository::class
];