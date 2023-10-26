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
        schema: 'UpdateTaskListsOrderDTO',
        required: ['taskListIds'],
        properties: [
            new OA\Property(property: 'taskListIds', type: 'array', items: new OA\Items(type: 'integer')),
        ]
    )
]
class UpdateTaskListsOrderDTO extends BaseRequestObjectMapper
{
    #[PropertyValidationRules(rules: 'required|array')]
    #[ArrayChildTypeMap(type: ArrayChildType::INTEGER)]
    public array $taskListIds;
}