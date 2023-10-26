<?php
declare(strict_types=1);
namespace App\Http\Controllers\Label;

use App\Http\Controllers\RestController;
use CoreKanban\Application\Contracts\UseCases\Label\GetAllLabelsUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Get;
use OpenApi\Attributes as OA;

class GetAllLabelsController extends RestController
{
    public function __construct(
        private GetAllLabelsUseCaseInterface $getAllLabelsUseCase
    ) {}

    #[
        OA\Get(
            path: '/labels/all',
            operationId: 'getAllLabels',
            tags: ['label'],
            responses: [
                new OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/LabelDTO')))
            ]
        )
    ]
    #[Get(uri: '/labels/all', middleware: 'auth:sanctum')]
    public function execute() : JsonResponse
    {
        return $this->jsonSuccessResponse(
            $this->getAllLabelsUseCase->execute()
        );
    }
}
