<?php
declare(strict_types=1);
namespace App\Http\Controllers\TaskList;

use App\Http\Controllers\RestController;
use CoreKanban\Application\Contracts\UseCases\TaskList\DeleteTaskListUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Delete;
use OpenApi\Attributes as OA;

class DeleteTaskListController extends RestController
{
    public function __construct(
        private DeleteTaskListUseCaseInterface $deleteTaskListUseCase
    ) {}

    #[
        OA\Delete(
            path: '/task-list/delete/{id}',
            operationId: 'deleteTaskList',
            tags: ['task-list'],
            parameters: [
                new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
            ],
            responses: [
                new OA\Response(response: 200, description: 'OK')
            ]
        )
    ]
    #[Delete(uri: '/task-list/delete/{id}', middleware: 'auth:sanctum')]
    public function execute(int $id) : JsonResponse
    {
        $this->deleteTaskListUseCase->execute($id);
        return $this->jsonSuccessResponse();
    }
}
