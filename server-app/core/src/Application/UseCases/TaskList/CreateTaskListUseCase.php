<?php
declare(strict_types=1);
namespace CoreKanban\Application\UseCases\TaskList;

use CoreKanban\Application\Contracts\UseCases\TaskList\CreateTaskListUseCaseInterface;
use CoreKanban\Application\DTO\Requests\CreateTaskListDTO;
use CoreKanban\Domain\Contracts\Repositories\TaskListRepositoryInterface;
use CoreKanban\Domain\Entities\TaskList\TaskList;

class CreateTaskListUseCase implements CreateTaskListUseCaseInterface
{
    public function __construct(
        private TaskListRepositoryInterface $taskListRepository
    ) {}

    public function execute(CreateTaskListDTO $createTaskListDTO) : void
    {
        $taskList = new TaskList();
        $taskList->setName($createTaskListDTO->name);
        $this->taskListRepository->createOrUpdateTaskList($taskList);
    }
}