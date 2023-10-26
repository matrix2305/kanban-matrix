<?php
declare(strict_types=1);
namespace App\Http\Controllers\TaskList;

use App\Http\Controllers\RestController;
use CoreKanban\Application\Contracts\UseCases\TaskList\CreateTaskListUseCaseInterface;
use CoreKanban\Application\DTO\Requests\CreateTaskListDTO;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Put;
use OpenApi\Attributes as OA;

class CreateTaskListController extends RestController
{
    public function __construct(
        private CreateTaskListUseCaseInterface $createTaskListUseCase
    ) {}

    #[
        OA\Put(
            path: '/task-list/create',
            operationId: 'createTaskList',
            requestBody: new OA\RequestBody(content: new OA\JsonContent(ref: '#/components/schemas/CreateTaskListDTO')),
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
    #[Put(uri: '/task-list/create', middleware: 'auth:sanctum')]
    public function execute(CreateTaskListDTO $createTaskListDTO) : JsonResponse
    {
        $this->createTaskListUseCase->execute($createTaskListDTO);
        return $this->jsonSuccessResponse();
    }
}
