<?php
declare(strict_types=1);
namespace CoreKanban\Domain\Contracts\Repositories;

use CoreKanban\Domain\Entities\TaskList\TaskList;

interface TaskListRepositoryInterface
{
    public function getTaskListById(int $id) : TaskList;

    public function getAllTaskLists() : array;

    public function getCompletedTaskList() : TaskList;

    public function createOrUpdateTaskList(TaskList $taskList) : void;

    public function deleteTaskList(TaskList $taskList) : void;
}