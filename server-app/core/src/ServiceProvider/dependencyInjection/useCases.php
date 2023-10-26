<?php
declare(strict_types=1);

return [
    CoreKanban\Application\Contracts\UseCases\Label\GetAllLabelsUseCaseInterface::class => CoreKanban\Application\UseCases\Label\GetAllLabelsUseCase::class,

    CoreKanban\Application\Contracts\UseCases\TaskList\CreateTaskListUseCaseInterface::class => CoreKanban\Application\UseCases\TaskList\CreateTaskListUseCase::class,
    CoreKanban\Application\Contracts\UseCases\TaskList\CreateTaskUseCaseInterface::class => CoreKanban\Application\UseCases\TaskList\CreateTaskUseCase::class,
    CoreKanban\Application\Contracts\UseCases\TaskList\DeleteTaskListUseCaseInterface::class => CoreKanban\Application\UseCases\TaskList\DeleteTaskListUseCase::class,
    CoreKanban\Application\Contracts\UseCases\TaskList\GetAllTaskListsUseCaseInterface::class => CoreKanban\Application\UseCases\TaskList\GetAllTaskListsUseCase::class,
    CoreKanban\Application\Contracts\UseCases\TaskList\GetCompletedTaskListUseCaseInterface::class => CoreKanban\Application\UseCases\TaskList\GetCompletedTaskListUseCase::class,
    CoreKanban\Application\Contracts\UseCases\TaskList\MoveTaskToAnotherTaskListUseCaseInterface::class => CoreKanban\Application\UseCases\TaskList\MoveTaskToAnotherTaskListUseCase::class,
    CoreKanban\Application\Contracts\UseCases\TaskList\UpdateTaskListUseCaseInterface::class => CoreKanban\Application\UseCases\TaskList\UpdateTaskListUseCase::class,
    CoreKanban\Application\Contracts\UseCases\TaskList\UpdateTasksOrderInTaskListUseCaseInterface::class => CoreKanban\Application\UseCases\TaskList\UpdateTasksOrderInTaskListUseCase::class,
    CoreKanban\Application\Contracts\UseCases\TaskList\UpdateTaskUseCaseInterface::class => CoreKanban\Application\UseCases\TaskList\UpdateTaskUseCase::class,
    CoreKanban\Application\Contracts\UseCases\TaskList\UpdateTaskListsOrderUseCaseInterface::class => CoreKanban\Application\UseCases\TaskList\UpdateTaskListsOrderUseCase::class,
    CoreKanban\Application\Contracts\UseCases\TaskList\CompleteAllTasksInListUseCaseInterface::class => CoreKanban\Application\UseCases\TaskList\CompleteAllTasksInListUseCase::class,

    CoreKanban\Application\Contracts\UseCases\User\GetAllUsersUseCaseInterface::class => CoreKanban\Application\UseCases\User\GetAllUsersUseCase::class,
    CoreKanban\Application\Contracts\UseCases\User\GetUserByEmailOrUsernameUseCaseInterface::class => CoreKanban\Application\UseCases\User\GetUserByEmailOrUsernameUseCase::class,
    CoreKanban\Application\Contracts\UseCases\User\GetUserByIdUseCaseInterface::class => CoreKanban\Application\UseCases\User\GetUserByIdUseCase::class
];