<?php
declare(strict_types=1);
namespace CoreKanban\Application\UseCases\TaskList;

use Carbon\Carbon;
use CoreKanban\Application\Contracts\UseCases\TaskList\UpdateTaskUseCaseInterface;
use CoreKanban\Application\DTO\Requests\UpdateTaskDTO;
use CoreKanban\Application\Exceptions\EntityNotFoundOnUpdateException;
use CoreKanban\Domain\Contracts\Repositories\LabelRepositoryInterface;
use CoreKanban\Domain\Contracts\Repositories\TaskListRepositoryInterface;
use CoreKanban\Domain\Contracts\Repositories\UserRepositoryInterface;
use CoreKanban\Domain\Entities\TaskList\Task;

class UpdateTaskUseCase implements UpdateTaskUseCaseInterface
{
    public function __construct(
        private TaskListRepositoryInterface $taskListRepository,
        private UserRepositoryInterface $userRepository,
        private LabelRepositoryInterface $labelRepository
    ) {}

    /**
     * @throws EntityNotFoundOnUpdateException
     */
    public function execute(UpdateTaskDTO $updateTaskDTO) : void
    {
        $taskList = $this->taskListRepository->getTaskListById($updateTaskDTO->taskListId);
        /** @var Task $task */
        $task = $taskList->getTasks()->filter(function (Task $task) use($updateTaskDTO) {
            return $task->getId() === $updateTaskDTO->id;
        })->first();

        if (!$task) {
            throw new EntityNotFoundOnUpdateException();
        }

        $task->setName($updateTaskDTO->name);
        $task->setDescription($updateTaskDTO->description);
        $task->setStartOn($updateTaskDTO->startOn ? Carbon::parse($updateTaskDTO->startOn) : null);
        $task->setDueOn($updateTaskDTO->dueOn ? Carbon::parse($updateTaskDTO->dueOn) : null);
        $task->getUsers()->clear();
        foreach ($updateTaskDTO->usersIds as $userId) {
            $task->getUsers()->add(
                $this->userRepository->getUserById($userId)
            );
        }
        $task->getLabels()->clear();
        foreach ($updateTaskDTO->labelsIds as $labelId) {
            $task->getLabels()->add(
                $this->labelRepository->getLabelById($labelId)
            );
        }
        $taskList->getTasks()->add($task);
        $this->taskListRepository->createOrUpdateTaskList($taskList);
    }
}