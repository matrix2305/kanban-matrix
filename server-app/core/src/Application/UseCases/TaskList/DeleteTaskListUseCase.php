<?php
declare(strict_types=1);
namespace CoreKanban\Application\UseCases\TaskList;

use CoreKanban\Application\Contracts\UseCases\TaskList\DeleteTaskListUseCaseInterface;
use CoreKanban\Domain\Contracts\Repositories\TaskListRepositoryInterface;

class DeleteTaskListUseCase implements DeleteTaskListUseCaseInterface
{
    public function __construct(
        private TaskListRepositoryInterface $taskListRepository
    ) {}

    public function execute(int $id) : void
    {
        $this->taskListRepository->deleteTaskList(
            $this->taskListRepository->getTaskListById($id)
        );
    }
}