<?php
declare(strict_types=1);
namespace CoreKanban\Application\UseCases\TaskList;

use CoreKanban\Application\Contracts\UseCases\TaskList\GetCompletedTaskListUseCaseInterface;
use CoreKanban\Application\DTO\Responses\TaskList\TaskListDTO;
use CoreKanban\Domain\Contracts\Repositories\TaskListRepositoryInterface;

class GetCompletedTaskListUseCase implements GetCompletedTaskListUseCaseInterface
{
    public function __construct(
        private TaskListRepositoryInterface $taskListRepository
    ) {}

    public function execute() : TaskListDTO
    {
        return TaskListDTO::fromEntity(
            $this->taskListRepository->getCompletedTaskList()
        );
    }
}