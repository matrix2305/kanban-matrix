<?php
declare(strict_types=1);
namespace CoreKanban\Application\Contracts\UseCases\TaskList;

use CoreKanban\Application\DTO\Requests\UpdateTaskListDTO;

interface UpdateTaskListUseCaseInterface
{
    public function execute(UpdateTaskListDTO $updateTaskListDTO) : void;
}