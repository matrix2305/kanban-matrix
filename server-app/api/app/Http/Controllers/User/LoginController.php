<?php
declare(strict_types=1);
namespace App\Http\Controllers\User;

use App\Http\Controllers\RestController;
use App\Models\User;
use CoreKanban\Application\Contracts\UseCases\User\GetUserByEmailOrUsernameUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\RouteAttributes\Attributes\Post;
use OpenApi\Attributes as OA;
use CoreKanban\Infrastructure\DataAccess\Exceptions\EntityNotFoundException;
class LoginController extends RestController
{
    public function __construct(
        private GetUserByEmailOrUsernameUseCaseInterface $getUserByEmailOrUsernameUseCase
    ) {}

    #[
        OA\Post(
            path: '/auth/user/login',
            operationId: 'userLogin',
            requestBody: new OA\RequestBody(content: new OA\JsonContent(
                title: 'UserLoginRequest',
                properties: [
                    new OA\Property(property: 'email', type: 'string'),
                    new OA\Property(property: 'password', type: 'string')
                ]
            )),
            tags: ['user'],
            responses: [
                new OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(
                    title: 'UserLoginResponse',
                    properties: [
                        new OA\Property(property: 'token', type: 'string'),
                        new OA\Property(property: 'user', ref: '#/components/schemas/UserDTO', type: 'object')
                    ]
                )),
                new OA\Response(response: 401, description: 'Unauthorized user')
            ]
        )
    ]
    #[Post(uri: '/auth/user/login')]
    public function execute(Request $request) : JsonResponse
    {
        $rules = [
            'email' => 'required|string',
            'password' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->jsonErrorException($validator->errors()->first());
        }

        try {
            $user = $this->getUserByEmailOrUsernameUseCase->execute($request->get('email'));
        } catch (EntityNotFoundException $exception) {
            return $this->jsonNotFoundResponse('User not found!');
        }

        $field = filter_var($request->get('email'), FILTER_VALIDATE_EMAIL) ? "email" : "username";

        if (Auth::guard('web')->attempt([$field => $request->get('email'), 'password' => $request->get('password')])) {
            /** @var User $authUser */
            $authUser = User::where($field, $request->get('email'))->first();
            return $this->jsonSuccessResponse(
                [
                    'user' => $user,
                    'token' => $authUser->createToken('authToken')->plainTextToken
                ]
            );
        }

        return $this->jsonErrorException('Bad password');
    }
}
