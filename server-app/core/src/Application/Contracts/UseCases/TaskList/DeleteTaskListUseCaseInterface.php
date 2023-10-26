<?php
declare(strict_types=1);
namespace CoreKanban\Application\Contracts\UseCases\TaskList;

interface DeleteTaskListUseCaseInterface
{
    public function execute(int $id) : void;
}