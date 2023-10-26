<?php
declare(strict_types=1);
namespace CoreKanban\Application\DTO\Requests;

use Matrix2305\RequestObjectMapper\Attributes\PropertyValidationRules;
use Matrix2305\RequestObjectMapper\BaseRequestObjectMapper;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'MoveTaskToAnotherTaskListDTO',
        required: ['taskId', 'taskListId', 'movedToTaskListId'],
        properties: [
            new OA\Property(property: 'taskId', type: 'integer'),
            new OA\Property(property: 'taskListId', type: 'integer'),
            new OA\Property(property: 'movedToTaskListId', type: 'integer'),
        ]
    )
]
class MoveTaskToAnotherTaskListDTO extends BaseRequestObjectMapper
{
    #[PropertyValidationRules(rules: 'required|integer')]
    public int $taskId;
    #[PropertyValidationRules(rules: 'required|integer')]
    public int $taskListId;
    #[PropertyValidationRules(rules: 'required|integer')]
    public int $movedToTaskListId;
}