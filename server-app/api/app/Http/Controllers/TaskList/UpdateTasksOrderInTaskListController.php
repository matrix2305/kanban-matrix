<?php
declare(strict_types=1);
namespace App\Http\Controllers\TaskList;

use App\Http\Controllers\RestController;
use CoreKanban\Application\Contracts\UseCases\TaskList\UpdateTasksOrderInTaskListUseCaseInterface;
use CoreKanban\Application\DTO\Requests\UpdateTasksOrderInTaskListDTO;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Post;
use OpenApi\Attributes as OA;
class UpdateTasksOrderInTaskListController extends RestController
{
    public function __construct(
        private UpdateTasksOrderInTaskListUseCaseInterface $updateTasksOrderInTaskListUseCase
    ) {}

    #[
        OA\Post(
            path: '/task-list/update-tasks-order',
            operationId: 'updateTasksOrderInTaskList',
            requestBody: new OA\RequestBody(content: new OA\JsonContent(ref: '#/components/schemas/UpdateTasksOrderInTaskListDTO')),
            tags: ['task-list'],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'OK',
                ),
                new OA\Response(response: 401, description: 'Unauthorized user')
            ]
        )
    ]
    #[Post(uri: '/task-list/update-tasks-order', middleware: 'auth:sanctum')]
    public function execute(UpdateTasksOrderInTaskListDTO $updateTasksOrderInTaskListDTO) : JsonResponse
    {
        $this->updateTasksOrderInTaskListUseCase->execute($updateTasksOrderInTaskListDTO);
        return $this->jsonSuccessResponse();
    }
}
