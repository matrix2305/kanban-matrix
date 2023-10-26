<?php
declare(strict_types=1);
namespace App\Http\Controllers\TaskList;

use App\Http\Controllers\RestController;
use CoreKanban\Application\Contracts\UseCases\TaskList\UpdateTaskUseCaseInterface;
use CoreKanban\Application\DTO\Requests\UpdateTaskDTO;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Post;
use OpenApi\Attributes as OA;

class UpdateTaskController extends RestController
{
    public function __construct(
        private UpdateTaskUseCaseInterface $updateTaskUseCase
    ) {}

    #[
        OA\Post(
            path: '/task-list/update-task',
            operationId: 'updateTask',
            requestBody: new OA\RequestBody(content: new OA\JsonContent(ref: '#/components/schemas/UpdateTaskDTO')),
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
    #[Post(uri: '/task-list/update-task', middleware: 'auth:sanctum')]
    public function execute(UpdateTaskDTO $updateTaskDTO) : JsonResponse
    {
        $this->updateTaskUseCase->execute($updateTaskDTO);
        return $this->jsonSuccessResponse();
    }
}
