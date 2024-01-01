<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\UnauthorizedException;
use Inertia\Inertia;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of error messages
     *
     * @var array<int, string>
     */
    protected $messages = [
        500 => 'Something went wrong',
        503 => 'Service unavailable',
        404 => 'Not found',
        403 => 'Not authorized',
    ];

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Prepare exception for rendering.
     *
     * @param \Throwable $e
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response|Throwable
     * @throws Throwable
     */
    public function render($request, Throwable $e): Throwable|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        $response = parent::render($request, $e);

        if (in_array($response->status(), [500, 503, 404, 403])) {
            return Inertia::render('Errors/Generic', [
                'status' => $response->status(),
                'previousUrl' => url()->previous()
            ])
                ->toResponse($request)
                ->setStatusCode($response->status());
        } elseif ($response->status() === 419) {
            return back()->with([
                'message' => 'The page expired, please try again.',
            ]);
        }

        return $response;
    }
}
