<?php
declare(strict_types=1);
namespace CoreKanban\Application\UseCases\TaskList;

use CoreKanban\Application\Contracts\UseCases\TaskList\GetAllTaskListsUseCaseInterface;
use CoreKanban\Application\DTO\Responses\TaskList\TaskListDTO;
use CoreKanban\Domain\Contracts\Repositories\TaskListRepositoryInterface;

class GetAllTaskListsUseCase implements GetAllTaskListsUseCaseInterface
{
    public function __construct(
        private TaskListRepositoryInterface $taskListRepository
    ) {}

    public function execute() : array
    {
        return TaskListDTO::fromArray(
            $this->taskListRepository->getAllTaskLists()
        );
    }
}