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
        schema: 'CreateTaskDTO',
        required: ['taskListId', 'name', 'description'],
        properties: [
            new OA\Property(property: 'taskListId', type: 'integer'),
            new OA\Property(property: 'name', type: 'string'),
            new OA\Property(property: 'description', type: 'string'),
            new OA\Property(property: 'startOn', type: 'string'),
            new OA\Property(property: 'dueOn', type: 'string'),
            new OA\Property(property: 'usersIds', type: 'array', items: new OA\Items(type: 'integer')),
            new OA\Property(property: 'labelIds', type: 'array', items: new OA\Items(type: 'integer')),
        ]
    )
]
class CreateTaskDTO extends BaseRequestObjectMapper
{
    #[PropertyValidationRules(rules: 'required|integer')]
    public int $taskListId;
    #[PropertyValidationRules(rules: 'required|string|max:256')]
    public string $name;
    #[PropertyValidationRules(rules: 'required|string')]
    public string $description;
    #[PropertyValidationRules(rules: 'sometimes|nullable|date')]
    public ?string $startOn;
    #[PropertyValidationRules(rules: 'sometimes|nullable|date')]
    public ?string $dueOn;
    #[PropertyValidationRules(rules: 'array')]
    #[ArrayChildTypeMap(type: ArrayChildType::INTEGER)]
    public array $usersIds;
    #[PropertyValidationRules(rules: 'array')]
    #[ArrayChildTypeMap(type: ArrayChildType::INTEGER)]
    public array $labelsIds;
}