<?php
declare(strict_types=1);
namespace CoreKanban\Application\UseCases\TaskList;

use CoreKanban\Application\Contracts\UseCases\TaskList\UpdateTaskListUseCaseInterface;
use CoreKanban\Application\DTO\Requests\UpdateTaskListDTO;
use CoreKanban\Domain\Contracts\Repositories\TaskListRepositoryInterface;

class UpdateTaskListUseCase implements UpdateTaskListUseCaseInterface
{
    public function __construct(
        private TaskListRepositoryInterface $taskListRepository
    ) {}

    public function execute(UpdateTaskListDTO $updateTaskListDTO) : void
    {
        $taskList = $this->taskListRepository->getTaskListById($updateTaskListDTO->id);
        $taskList->setName($updateTaskListDTO->name);
        $this->taskListRepository->createOrUpdateTaskList($taskList);
    }
}