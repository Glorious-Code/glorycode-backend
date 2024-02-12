<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Router;
use Lorisleiva\Actions\Concerns\AsAction;

class ResendEmailVerificationLink
{
    use AsAction;

    public function handle()
    {
        // ...
    }

    public function asController(Request $request): \Illuminate\Contracts\Foundation\Application|ResponseFactory|Application|Response
    {
        $request->user()->sendEmailVerificationNotification();

        return response([
            'data' => [
                'message' => 'Verification Link has been send to your email.'
            ]
        ]);
    }

    public static function routes(Router $router): void
    {
        $router->post('email/verification-notification', static::class)
            ->middleware(['api', 'auth:sanctum', 'throttle:6,1'])
            ->prefix('api')
            ->name('verification.send');
    }
}
