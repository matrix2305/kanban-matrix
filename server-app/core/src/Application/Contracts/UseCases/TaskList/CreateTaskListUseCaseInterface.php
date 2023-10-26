<?php
declare(strict_types=1);
namespace CoreKanban\Application\Contracts\UseCases\TaskList;

use CoreKanban\Application\DTO\Requests\CreateTaskListDTO;

interface CreateTaskListUseCaseInterface
{
    public function execute(CreateTaskListDTO $createTaskListDTO) : void;
}