<?php
declare(strict_types=1);
namespace CoreKanban\Application\Contracts\UseCases\TaskList;

use CoreKanban\Application\DTO\Requests\UpdateTaskDTO;

interface UpdateTaskUseCaseInterface
{
    public function execute(UpdateTaskDTO $updateTaskDTO) : void;
}