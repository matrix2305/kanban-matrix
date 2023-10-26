<?php
declare(strict_types=1);
namespace App\Http\Controllers\TaskList;

use App\Http\Controllers\RestController;
use CoreKanban\Application\Contracts\UseCases\TaskList\GetCompletedTaskListUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Get;
use OpenApi\Attributes as OA;

class GetCompletedTaskListController extends RestController
{
    public function __construct(
        private GetCompletedTaskListUseCaseInterface $getCompletedTaskListUseCase
    ) {}

    #[
        OA\Get(
            path: '/task-list/completed-task-list',
            operationId: 'getCompletedTaskList',
            tags: ['task-list'],
            responses: [
                new OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: '#/components/schemas/TaskListDTO'))
            ]
        )
    ]
    #[Get(uri: '/task-list/completed-task-list', middleware: 'auth:sanctum')]
    public function execute() : JsonResponse
    {
        return $this->jsonSuccessResponse(
            $this->getCompletedTaskListUseCase->execute()
        );
    }
}
