<?php
declare(strict_types=1);
namespace CoreKanban\Application\Contracts\UseCases\TaskList;

use CoreKanban\Application\DTO\Requests\UpdateTaskListsOrderDTO;

interface UpdateTaskListsOrderUseCaseInterface
{
    public function execute(UpdateTaskListsOrderDTO $updateTaskListsOrderDTO) : void;
}