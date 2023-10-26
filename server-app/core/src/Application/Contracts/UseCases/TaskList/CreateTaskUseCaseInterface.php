<?php
declare(strict_types=1);
namespace CoreKanban\Application\Contracts\UseCases\TaskList;

use CoreKanban\Application\DTO\Requests\CreateTaskDTO;

interface CreateTaskUseCaseInterface
{
    public function execute(CreateTaskDTO $createTaskDTO) : void;
}