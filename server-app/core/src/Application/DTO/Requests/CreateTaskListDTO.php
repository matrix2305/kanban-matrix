<?php
declare(strict_types=1);
namespace CoreKanban\Application\DTO\Requests;

use Matrix2305\RequestObjectMapper\Attributes\PropertyValidationRules;
use Matrix2305\RequestObjectMapper\BaseRequestObjectMapper;
use OpenApi\Attributes as OA;

#[
    OA\Schema(
        schema: 'CreateTaskListDTO',
        required: ['name'],
        properties: [
            new OA\Property(property: 'name', type: 'string'),
        ]
    )
]
class CreateTaskListDTO extends BaseRequestObjectMapper
{
    #[PropertyValidationRules(rules: 'required|string|max:256')]
    public string $name;
}