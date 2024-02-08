<?php

namespace App\Actions\Profile;

use App\Http\Resources\User\UserDataResource;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUserDetails
{
    use AsAction;

    public static function routes(Router $router): void
    {
        $router->get('auth/user', static::class)
            ->middleware(['api', 'auth:sanctum'])
            ->prefix('api')
            ->name('user_data');
    }

    public function handle(): array
    {
        return [
            'user' => Auth::user()
        ];
    }

    public function asController(): array
    {
        return $this->handle();
    }

    public function jsonResponse(array $data): \Illuminate\Http\Resources\Json\JsonResource
    {
        return new UserDataResource($data['user']);
    }
}
