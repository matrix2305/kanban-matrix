<?php
declare(strict_types=1);
namespace CoreKanban\Application\Contracts\UseCases\TaskList;

use CoreKanban\Application\DTO\Requests\MoveTaskToAnotherTaskListDTO;

interface MoveTaskToAnotherTaskListUseCaseInterface
{
    public function execute(MoveTaskToAnotherTaskListDTO $moveTaskToAnotherTaskListDTO) : void;
}