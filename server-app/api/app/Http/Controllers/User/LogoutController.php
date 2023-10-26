<?php
declare(strict_types=1);
namespace App\Http\Controllers\User;

use App\Http\Controllers\RestController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Spatie\RouteAttributes\Attributes\Post;
use OpenApi\Attributes as OA;

class LogoutController extends RestController
{
    #[
        OA\Post(
            path: '/auth/user/logout',
            operationId: 'userLogout',
            tags: ['user'],
            responses: [
                new OA\Response(response: 200, description: 'OK'),
                new OA\Response(response: 401, description: 'Unauthorized user')
            ]
        )
    ]
    #[Post(uri: '/auth/user/logout')]
    public function logout(Request $request) : JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user) {
            $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        }
        return $this->jsonSuccessResponse();
    }
}
