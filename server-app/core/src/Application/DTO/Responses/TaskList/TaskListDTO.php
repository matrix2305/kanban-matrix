<?php
declare(strict_types=1);
namespace CoreKanban\Application\DTO\Responses\TaskList;

use CoreKanban\Application\DTO\Responses\BaseDTO;
use CoreKanban\Domain\Entities\TaskList\TaskList;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'TaskListDTO',
        properties: [
            new OA\Property(property: 'id', type: 'integer'),
            new OA\Property(property: 'order', type: 'integer'),
            new OA\Property(property: 'name', type: 'string'),
            new OA\Property(property: 'completedTaskList', type: 'boolean'),
            new OA\Property(property: 'tasks', type: 'array', items: new OA\Items(ref: '#/components/schemas/TaskDTO')),
        ]
    )
]
class TaskListDTO extends BaseDTO
{
    public int $id;
    public int $order;
    public string $name;
    public bool $completedTaskList;
    public array $tasks;

    public static function fromEntity(TaskList $taskList) : self
    {
        return new self([
            'id' => $taskList->getId(),
            'order' => $taskList->getOrder(),
            'name' => $taskList->getName(),
            'completedTaskList' => $taskList->isCompletedTaskList(),
            'tasks' => TaskDTO::fromArray($taskList->getTasks(true)->toArray())
        ]);
    }

    public static function fromArray(array $entities) : array
    {
        $dtos = [];

        if (!empty($entities)) {
            foreach ($entities as $entity) {
                if ($entity instanceof TaskList) {
                    $dtos[] = self::fromEntity($entity);
                }
            }
        }

        return $dtos;
    }
}