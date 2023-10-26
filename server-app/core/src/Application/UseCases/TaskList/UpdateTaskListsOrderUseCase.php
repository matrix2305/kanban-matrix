<?php
declare(strict_types=1);
namespace CoreKanban\Application\UseCases\TaskList;

use CoreKanban\Application\Contracts\UseCases\TaskList\UpdateTaskListsOrderUseCaseInterface;
use CoreKanban\Application\DTO\Requests\UpdateTaskListsOrderDTO;
use CoreKanban\Domain\Contracts\Repositories\TaskListRepositoryInterface;

class UpdateTaskListsOrderUseCase implements UpdateTaskListsOrderUseCaseInterface
{
    public function __construct(
        private TaskListRepositoryInterface $taskListRepository
    ) {}

    public function execute(UpdateTaskListsOrderDTO $updateTaskListsOrderDTO) : void
    {
        foreach ($updateTaskListsOrderDTO->taskListIds as $order => $taskListId) {
            $taskList = $this->taskListRepository->getTaskListById($taskListId);
            $taskList->setOrder($order);
            $this->taskListRepository->createOrUpdateTaskList($taskList);
        }
    }
}