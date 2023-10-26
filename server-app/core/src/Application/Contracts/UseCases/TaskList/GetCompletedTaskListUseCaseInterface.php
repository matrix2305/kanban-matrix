<?php
declare(strict_types=1);
namespace CoreKanban\Application\Contracts\UseCases\TaskList;

use CoreKanban\Application\DTO\Responses\TaskList\TaskListDTO;

interface GetCompletedTaskListUseCaseInterface
{
    public function execute() : TaskListDTO;
}