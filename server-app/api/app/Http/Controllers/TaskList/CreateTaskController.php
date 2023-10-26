<?php
declare(strict_types=1);
namespace App\Http\Controllers\TaskList;

use App\Http\Controllers\RestController;
use CoreKanban\Application\Contracts\UseCases\TaskList\CreateTaskUseCaseInterface;
use CoreKanban\Application\DTO\Requests\CreateTaskDTO;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Put;
use OpenApi\Attributes as OA;

class CreateTaskController extends RestController
{
    public function __construct(
        private CreateTaskUseCaseInterface $createTaskUseCase
    ) {}

    #[
        OA\Put(
            path: '/task-list/create-task',
            operationId: 'createTask',
            requestBody: new OA\RequestBody(content: new OA\JsonContent(ref: '#/components/schemas/CreateTaskDTO')),
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
    #[Put(uri: '/task-list/create-task', middleware: 'auth:sanctum')]
    public function execute(CreateTaskDTO $createTaskDTO) : JsonResponse
    {
        $this->createTaskUseCase->execute($createTaskDTO);
        return $this->jsonSuccessResponse();
    }
}
