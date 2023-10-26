<?php
declare(strict_types=1);
namespace App\Http\Controllers\User;

use App\Http\Controllers\RestController;
use CoreKanban\Application\Contracts\UseCases\User\GetUserByIdUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\Get;
use OpenApi\Attributes as OA;

class GetAuthenticatedUserController extends RestController
{
    public function __construct(
        private GetUserByIdUseCaseInterface $getUserByIdUseCase
    ) {}

    #[
        OA\Get(
            path: '/auth/user',
            operationId: 'getAuthUser',
            tags: ['user'],
            responses: [
                new OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: '#/components/schemas/UserDTO'))
            ]
        )
    ]
    #[Get(uri: '/auth/user', middleware: 'auth:sanctum')]
    public function execute() : JsonResponse
    {
        return $this->jsonSuccessResponse(
            $this->getUserByIdUseCase->execute((int)Auth::id())
        );
    }
}
