<?php
declare(strict_types=1);
namespace CoreKanban\Application\UseCases\TaskList;

use Carbon\Carbon;
use CoreKanban\Application\Contracts\UseCases\TaskList\CompleteAllTasksInListUseCaseInterface;
use CoreKanban\Domain\Contracts\Repositories\TaskListRepositoryInterface;
use CoreKanban\Domain\Entities\TaskList\Task;

class CompleteAllTasksInListUseCase implements CompleteAllTasksInListUseCaseInterface
{
    public function __construct(
        private TaskListRepositoryInterface $taskListRepository
    ) {}

    public function execute(int $taskListId) : void
    {
        $taskList = $this->taskListRepository->getTaskListById($taskListId);
        $completedTaskList = $this->taskListRepository->getCompletedTaskList();

        /** @var Task $task */
        foreach ($taskList->getTasks() as $task) {
            $task->setOrder(0);
            $task->setTaskList($completedTaskList);
            $task->setCompletedOn(Carbon::now());
            $completedTaskList->getTasks()->add($task);
        }

        $this->taskListRepository->createOrUpdateTaskList($taskList);
    }
}