<?php
declare(strict_types=1);
namespace CoreKanban\Application\Contracts\UseCases\TaskList;

use CoreKanban\Application\DTO\Requests\UpdateTasksOrderInTaskListDTO;

interface UpdateTasksOrderInTaskListUseCaseInterface
{
    public function execute(UpdateTasksOrderInTaskListDTO $updateTasksOrderInTaskListDTO) : void;
}