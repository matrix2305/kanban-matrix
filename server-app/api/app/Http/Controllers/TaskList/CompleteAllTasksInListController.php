<?php
declare(strict_types=1);
namespace App\Http\Controllers\TaskList;

use App\Http\Controllers\RestController;
use CoreKanban\Application\Contracts\UseCases\TaskList\CompleteAllTasksInListUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Get;
use OpenApi\Attributes as OA;

class CompleteAllTasksInListController extends RestController
{
    public function __construct(
        private CompleteAllTasksInListUseCaseInterface $completeAllTasksInListUseCase
    ) {}

    #[
        OA\Get(
            path: '/task-list/complete-tasks-in-list/{id}',
            operationId: 'completeAllTasksInList',
            tags: ['task-list'],
            parameters: [
                new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
            ],
            responses: [
                new OA\Response(response: 200, description: 'OK')
            ]
        )
    ]
    #[Get(uri: '/task-list/complete-tasks-in-list/{id}', middleware: 'auth:sanctum')]
    public function execute(int $id) : JsonResponse
    {
        $this->completeAllTasksInListUseCase->execute($id);
        return $this->jsonSuccessResponse();
    }
}
