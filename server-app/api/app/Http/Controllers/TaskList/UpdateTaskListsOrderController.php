<?php
declare(strict_types=1);
namespace App\Http\Controllers\TaskList;

use App\Http\Controllers\RestController;
use CoreKanban\Application\Contracts\UseCases\TaskList\UpdateTaskListsOrderUseCaseInterface;
use CoreKanban\Application\DTO\Requests\UpdateTaskListsOrderDTO;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Post;
use OpenApi\Attributes as OA;

class UpdateTaskListsOrderController extends RestController
{
    public function __construct(
        private UpdateTaskListsOrderUseCaseInterface $updateTaskListsOrderUseCase
    ) {}

    #[
        OA\Post(
            path: '/task-list/update-order',
            operationId: 'updateTaskListsOrder',
            requestBody: new OA\RequestBody(content: new OA\JsonContent(ref: '#/components/schemas/UpdateTaskListsOrderDTO')),
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
    public function execute(UpdateTaskListsOrderDTO $updateTaskListsOrderDTO) : JsonResponse
    {
        $this->updateTaskListsOrderUseCase->execute($updateTaskListsOrderDTO);
        return $this->jsonSuccessResponse();
    }
}
