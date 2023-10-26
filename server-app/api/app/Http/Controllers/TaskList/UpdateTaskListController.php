<?php
declare(strict_types=1);
namespace App\Http\Controllers\TaskList;

use App\Http\Controllers\RestController;
use CoreKanban\Application\Contracts\UseCases\TaskList\UpdateTaskListUseCaseInterface;
use CoreKanban\Application\DTO\Requests\UpdateTaskListDTO;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Post;
use OpenApi\Attributes as OA;

class UpdateTaskListController extends RestController
{
    public function __construct(
        private UpdateTaskListUseCaseInterface $updateTaskListUseCase
    ) {}

    #[
        OA\Post(
            path: '/task-list/update',
            operationId: 'updateTaskList',
            requestBody: new OA\RequestBody(content: new OA\JsonContent(ref: '#/components/schemas/UpdateTaskListDTO')),
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
    #[Post(uri: '/task-list/update', middleware: 'auth:sanctum')]
    public function execute(UpdateTaskListDTO $updateTaskListDTO) : JsonResponse
    {
        $this->updateTaskListUseCase->execute($updateTaskListDTO);
        return $this->jsonSuccessResponse();
    }
}
