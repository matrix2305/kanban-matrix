<?php
declare(strict_types=1);
namespace App\Http\Controllers\User;

use App\Http\Controllers\RestController;
use CoreKanban\Application\Contracts\UseCases\User\GetAllUsersUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Get;
use OpenApi\Attributes as OA;

class GetAllUsersController extends RestController
{
    public function __construct(
        private GetAllUsersUseCaseInterface $getAllUsersUseCase
    ) {}

    #[
        OA\Get(
            path: '/user/all',
            operationId: 'getAllUsers',
            tags: ['user'],
            responses: [
                new OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/UserDTO')))
            ]
        )
    ]
    #[Get(uri: '/user/all', middleware: 'auth:sanctum')]
    public function execute() : JsonResponse
    {
        return $this->jsonSuccessResponse(
            $this->getAllUsersUseCase->execute()
        );
    }
}
