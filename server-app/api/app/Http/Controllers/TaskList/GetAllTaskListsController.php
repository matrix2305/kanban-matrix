<?php
declare(strict_types=1);
namespace App\Http\Controllers\TaskList;

use App\Http\Controllers\RestController;
use CoreKanban\Application\Contracts\UseCases\TaskList\GetAllTaskListsUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Get;
use OpenApi\Attributes as OA;

class GetAllTaskListsController extends RestController
{
    public function __construct(
        private GetAllTaskListsUseCaseInterface $getAllTaskListsUseCase
    ) {}

    #[
        OA\Get(
            path: '/task-list/all',
            operationId: 'getAllTaskLists',
            tags: ['task-list'],
            responses: [
                new OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/TaskListDTO')))
            ]
        )
    ]
    #[Get(uri: '/task-list/all', middleware: 'auth:sanctum')]
    public function execute() : JsonResponse
    {
        return $this->jsonSuccessResponse(
            $this->getAllTaskListsUseCase->execute()
        );
    }
}
