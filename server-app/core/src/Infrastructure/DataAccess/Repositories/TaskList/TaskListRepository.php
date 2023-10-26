<?php
declare(strict_types=1);
namespace CoreKanban\Infrastructure\DataAccess\Repositories\TaskList;

use CoreKanban\Domain\Contracts\Repositories\TaskListRepositoryInterface;
use CoreKanban\Domain\Entities\TaskList\TaskList;
use CoreKanban\Infrastructure\DataAccess\Exceptions\EntityNotFoundException;
use CoreKanban\Infrastructure\DataAccess\Repositories\BaseRepository;

class TaskListRepository extends BaseRepository implements TaskListRepositoryInterface
{
    protected string $entity = TaskList::class;

    public function getTaskListById(int $id) : TaskList
    {
        return $this->findOne($id);
    }

    public function getAllTaskLists() : array
    {
        $query = $this->em->createQueryBuilder();
        $query->select('tl')->from($this->entity, 'tl');
        $query->where('tl.completedTaskList != 1');
        $query->orderBy('tl.order', 'ASC');
        return $query->getQuery()->getResult();
    }

    public function getCompletedTaskList() : TaskList
    {
        $entity = $this->em->getRepository($this->entity)->findOneBy(['completedTaskList' => true]);
        if (!$entity) {
            throw new EntityNotFoundException();
        }

        return $entity;
    }

    public function createOrUpdateTaskList(TaskList $taskList) : void
    {
        $this->createOrUpdate($taskList);
    }

    public function deleteTaskList(TaskList $taskList) : void
    {
        $this->remove($taskList);
    }
}