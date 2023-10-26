<?php
declare(strict_types=1);
namespace CoreKanban\Application\UseCases\TaskList;

use Carbon\Carbon;
use CoreKanban\Application\Contracts\UseCases\TaskList\CreateTaskUseCaseInterface;
use CoreKanban\Application\DTO\Requests\CreateTaskDTO;
use CoreKanban\Domain\Contracts\Repositories\LabelRepositoryInterface;
use CoreKanban\Domain\Contracts\Repositories\TaskListRepositoryInterface;
use CoreKanban\Domain\Contracts\Repositories\UserRepositoryInterface;
use CoreKanban\Domain\Entities\TaskList\Task;

class CreateTaskUseCase implements CreateTaskUseCaseInterface
{
    public function __construct(
        private TaskListRepositoryInterface $taskListRepository,
        private UserRepositoryInterface $userRepository,
        private LabelRepositoryInterface $labelRepository
    ) {}

    public function execute(CreateTaskDTO $createTaskDTO) : void
    {
        $taskList = $this->taskListRepository->getTaskListById($createTaskDTO->taskListId);
        $task = new Task();
        $task->setName($createTaskDTO->name);
        $task->setDescription($createTaskDTO->description);
        $task->setStartOn($createTaskDTO->startOn ? Carbon::parse($createTaskDTO->startOn) : null);
        $task->setDueOn($createTaskDTO->dueOn ? Carbon::parse($createTaskDTO->dueOn) : null);
        foreach ($createTaskDTO->usersIds as $userId) {
            $task->getUsers()->add(
                $this->userRepository->getUserById($userId)
            );
        }
        foreach ($createTaskDTO->labelsIds as $labelId) {
            $task->getLabels()->add(
                $this->labelRepository->getLabelById($labelId)
            );
        }
        $task->setTaskList($taskList);
        $taskList->getTasks()->add($task);
        $this->taskListRepository->createOrUpdateTaskList($taskList);
    }
}