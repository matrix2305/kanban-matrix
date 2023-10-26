<?php
declare(strict_types=1);
namespace CoreKanban\Application\Contracts\UseCases\TaskList;

interface GetAllTaskListsUseCaseInterface
{
    public function execute() : array;
}