<?php
declare(strict_types=1);
namespace CoreKanban\Application\UseCases\TaskList;

use CoreKanban\Application\Contracts\UseCases\TaskList\UpdateTasksOrderInTaskListUseCaseInterface;
use CoreKanban\Application\DTO\Requests\UpdateTasksOrderInTaskListDTO;
use CoreKanban\Application\Exceptions\EntityNotFoundOnUpdateException;
use CoreKanban\Domain\Contracts\Repositories\TaskListRepositoryInterface;
use CoreKanban\Domain\Entities\TaskList\Task;

class UpdateTasksOrderInTaskListUseCase implements UpdateTasksOrderInTaskListUseCaseInterface
{
    public function __construct(
        private TaskListRepositoryInterface $taskListRepository
    ) {}

    /**
     * @throws EntityNotFoundOnUpdateException
     */
    public function execute(UpdateTasksOrderInTaskListDTO $updateTasksOrderInTaskListDTO) : void
    {
        $taskList = $this->taskListRepository->getTaskListById($updateTasksOrderInTaskListDTO->id);
        /** @var Task $task */

        foreach ($updateTasksOrderInTaskListDTO->taskIds as $order => $taskId) {
            /** @var Task $task */
            $task = $taskList->getTasks()->filter(function (Task $task) use($taskId) {
                return $task->getId() === $taskId;
            })->first();

            if (!$task) {
                throw new EntityNotFoundOnUpdateException();
            }

            $task->setOrder($order);
        }

        $this->taskListRepository->createOrUpdateTaskList($taskList);
    }
}