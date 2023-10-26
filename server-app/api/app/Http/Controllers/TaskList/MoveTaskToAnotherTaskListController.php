<?php
declare(strict_types=1);
namespace App\Http\Controllers\TaskList;

use App\Http\Controllers\RestController;
use CoreKanban\Application\Contracts\UseCases\TaskList\MoveTaskToAnotherTaskListUseCaseInterface;
use CoreKanban\Application\DTO\Requests\MoveTaskToAnotherTaskListDTO;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Post;
use OpenApi\Attributes as OA;

class MoveTaskToAnotherTaskListController extends RestController
{
    public function __construct(
        private MoveTaskToAnotherTaskListUseCaseInterface $moveTaskToAnotherTaskListUseCase
    ) {}

    #[
        OA\Post(
            path: '/task-list/move-task-to-another-list',
            operationId: 'moveTaskToAnotherTaskList',
            requestBody: new OA\RequestBody(content: new OA\JsonContent(ref: '#/components/schemas/MoveTaskToAnotherTaskListDTO')),
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
    #[Post(uri: '/task-list/move-task-to-another-list', middleware: 'auth:sanctum')]
    public function execute(MoveTaskToAnotherTaskListDTO $moveTaskToAnotherTaskListDTO) : JsonResponse
    {
        $this->moveTaskToAnotherTaskListUseCase->execute($moveTaskToAnotherTaskListDTO);
        return $this->jsonSuccessResponse();
    }
}
