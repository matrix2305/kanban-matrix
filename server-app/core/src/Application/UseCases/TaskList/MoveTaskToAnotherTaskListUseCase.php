<?php
declare(strict_types=1);
namespace CoreKanban\Application\UseCases\TaskList;

use Carbon\Carbon;
use CoreKanban\Application\Contracts\UseCases\TaskList\MoveTaskToAnotherTaskListUseCaseInterface;
use CoreKanban\Application\DTO\Requests\MoveTaskToAnotherTaskListDTO;
use CoreKanban\Application\Exceptions\EntityNotFoundOnUpdateException;
use CoreKanban\Domain\Contracts\Repositories\TaskListRepositoryInterface;
use CoreKanban\Domain\Entities\TaskList\Task;

class MoveTaskToAnotherTaskListUseCase implements MoveTaskToAnotherTaskListUseCaseInterface
{
    public function __construct(
        private TaskListRepositoryInterface $taskListRepository
    ) {}

    /**
     * @throws EntityNotFoundOnUpdateException
     */
    public function execute(MoveTaskToAnotherTaskListDTO $moveTaskToAnotherTaskListDTO) : void
    {
        if ($moveTaskToAnotherTaskListDTO->taskListId === $moveTaskToAnotherTaskListDTO->movedToTaskListId) {
            return;
        }

        $taskList = $this->taskListRepository->getTaskListById($moveTaskToAnotherTaskListDTO->taskListId);
        /** @var Task $task */
        $task = $taskList->getTasks()->filter(function (Task $task) use($moveTaskToAnotherTaskListDTO) {
            return $task->getId() === $moveTaskToAnotherTaskListDTO->taskId;
        })->first();

        if (!$task) {
            throw new EntityNotFoundOnUpdateException();
        }

        $taskListForMove = $this->taskListRepository->getTaskListById($moveTaskToAnotherTaskListDTO->movedToTaskListId);

        $task->setOrder(0);
        $task->setTaskList($taskListForMove);
        $task->setCompletedOn($taskListForMove->isCompletedTaskList() ? Carbon::now() : null);

        $taskListForMove->getTasks()->add($task);

        $this->taskListRepository->createOrUpdateTaskList($taskListForMove);
    }
}