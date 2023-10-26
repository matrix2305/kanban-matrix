<?php
declare(strict_types=1);
namespace CoreKanban\Application\DTO\Requests;

use Matrix2305\RequestObjectMapper\Attributes\ArrayChildTypeMap;
use Matrix2305\RequestObjectMapper\Attributes\PropertyValidationRules;
use Matrix2305\RequestObjectMapper\BaseRequestObjectMapper;
use Matrix2305\RequestObjectMapper\Enums\ArrayChildType;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'UpdateTasksOrderInTaskListDTO',
        required: ['id', 'taskIds'],
        properties: [
            new OA\Property(property: 'id', type: 'integer'),
            new OA\Property(property: 'taskIds', type: 'array', items: new OA\Items(type: 'integer')),
        ]
    )
]
class UpdateTasksOrderInTaskListDTO extends BaseRequestObjectMapper
{
    #[PropertyValidationRules(rules: 'required|integer')]
    public int $id;
    #[PropertyValidationRules(rules: 'required|array')]
    #[ArrayChildTypeMap(type: ArrayChildType::INTEGER)]
    public array $taskIds;
}