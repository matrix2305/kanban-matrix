<?php
declare(strict_types=1);
namespace CoreKanban\Application\DTO\Responses\TaskList;

use CoreKanban\Application\DTO\Responses\BaseDTO;
use CoreKanban\Application\DTO\Responses\Label\LabelDTO;
use CoreKanban\Application\DTO\Responses\User\UserDTO;
use CoreKanban\Domain\Entities\TaskList\Task;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'TaskDTO',
        properties: [
            new OA\Property(property: 'id', type: 'integer'),
            new OA\Property(property: 'order', type: 'integer'),
            new OA\Property(property: 'name', type: 'string'),
            new OA\Property(property: 'description', type: 'string'),
            new OA\Property(property: 'startOn', type: 'string', nullable: true),
            new OA\Property(property: 'dueOn', type: 'string', nullable: true),
            new OA\Property(property: 'users', type: 'array', items: new OA\Items(ref: '#/components/schemas/UserDTO')),
            new OA\Property(property: 'labels', type: 'array', items: new OA\Items(ref: '#/components/schemas/LabelDTO')),
        ]
    )
]
class TaskDTO extends BaseDTO
{
    public int $id;
    public int $order;
    public string $name;
    public string $description;
    public ?string $startOn;
    public ?string $dueOn;
    public array $users;
    public array $labels;

    public static function fromEntity(Task $task) : self
    {
        return new self([
            'id' => $task->getId(),
            'order' => $task->getOrder(),
            'name' => $task->getName(),
            'description' => $task->getDescription(),
            'startOn' => $task->getStartOn()?->format(self::$dateFormat),
            'dueOn' => $task->getDueOn()?->format(self::$dateFormat),
            'users' => UserDTO::fromArray($task->getUsers()->toArray()),
            'labels' => LabelDTO::fromArray($task->getLabels()->toArray())
        ]);
    }

    public static function fromArray(array $entities) : array
    {
        $dtos = [];
        if (!empty($entities)) {
            foreach ($entities as $entity) {
                if ($entity instanceof Task) {
                    $dtos[] = self::fromEntity($entity);
                }
            }
        }

        return $dtos;
    }
}