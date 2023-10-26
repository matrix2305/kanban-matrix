<?php
declare(strict_types=1);
namespace CoreKanban\Infrastructure\DataAccess\Seeds;

use CoreKanban\Domain\Contracts\Repositories\TaskListRepositoryInterface;
use CoreKanban\Domain\Entities\TaskList\TaskList;

class TaskListSeed extends BaseSeed
{
    public function __construct(
        private TaskListRepositoryInterface $taskListRepository
    ) {}

    public function seed(): void
    {
        $taskList = new TaskList();
        $taskList->setName('Completed Tasks');
        $taskList->setCompletedTaskList(true);
        $this->taskListRepository->createOrUpdateTaskList($taskList);
    }
}