<?php
declare(strict_types=1);
namespace CoreKanban\Application\Contracts\UseCases\TaskList;

interface CompleteAllTasksInListUseCaseInterface
{
    public function execute(int $taskListId) : void;
}