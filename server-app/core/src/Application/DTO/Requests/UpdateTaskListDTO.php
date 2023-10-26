<?php
declare(strict_types=1);
namespace CoreKanban\Application\DTO\Requests;

use Matrix2305\RequestObjectMapper\Attributes\PropertyValidationRules;
use Matrix2305\RequestObjectMapper\BaseRequestObjectMapper;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'UpdateTaskListDTO',
        required: ['id', 'name'],
        properties: [
            new OA\Property(property: 'id', type: 'integer'),
            new OA\Property(property: 'name', type: 'string'),
        ]
    )
]
class UpdateTaskListDTO extends BaseRequestObjectMapper
{
    #[PropertyValidationRules(rules: 'required|integer')]
    public int $id;
    #[PropertyValidationRules(rules: 'required|string|max:256')]
    public string $name;
}