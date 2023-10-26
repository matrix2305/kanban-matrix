<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

#[
    OA\Info(version: '1.0', title: 'Kanban application'),
    OA\Server(
        url: L5_SWAGGER_CONST_HOST
    ),
    OA\SecurityScheme(
        securityScheme: 'sanctum',
        type: 'http',
        scheme: 'bearer'
    ),
]
class RestController extends Controller
{
    public function jsonSuccessResponse(object|array $data = [], int $status = 200) : JsonResponse
    {
        return new JsonResponse($data, $status);
    }

    public function jsonUnauthorizedResponse(string $message = "Unauthorized", int $status = 401) : JsonResponse
    {
        return new JsonResponse(['message' => $message], $status);
    }

    public function jsonNotFoundResponse(string $message = "Page not found!", int $status = 404) : JsonResponse
    {
        return new JsonResponse(['message' => $message], $status);
    }

    public function jsonErrorException(string $message, int $status = 400) : JsonResponse
    {
        return new JsonResponse(['message' => $message], $status);
    }

    public function validationMessage(string $key) : ?string
    {
        return trans('validations.'.$key);
    }
}
