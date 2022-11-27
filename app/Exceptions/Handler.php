<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Validation\ValidationException;
use App\Exceptions\BusinessException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use League\OAuth2\Server\Exception\OAuthServerException;
use App\Exceptions\UnMatchPasswordException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        ValidationException::class,
        BusinessException::class,
        OAuthServerException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            return $this->renderJson($request, $exception);
        }
        return parent::render($request, $exception);
    }

    protected function renderJson($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->json(['error' => $exception->getMessage() ?? 'resource.not_found', 'message' => 'Error!'], 404);
        }
        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json(['error' => 'api.method_not_allowed', 'message' => 'Error!'], 405);
        }
        if ($exception instanceof ValidationException) {
            $data = $exception->validator->errors()->getMessages();
            return response()->json(['error' => 'data.invalid', 'data' => $data], 422);
        }
        if ($exception instanceof AuthenticationException) {
            return response()->json(['error' => 'api.unauthenticated', 'message' => 'Unauthenticated'], 401);
        }
        if ($exception instanceof AuthorizationException) {
            return response()->json(['error' => 'api.unauthorized', 'message' => 'This action is unauthorized'], 403);
        }
        if ($exception instanceof BusinessException) {
            $res = ['error' => $exception->getError(), 'message' => $exception->getMessage()];
            if ($exception->getData()) {
                $res = ['error' => $exception->getError(), 'message' => $exception->getMessage(), 'data' => $exception->getData()];
            }
            return response()->json($res, 400);
        }
        if (config('app.debug')) {
            // Enable error trace in debug mode
            return parent::render($request, $exception);
        }
        return response()->json(['error' => 'api.error', 'message' => $exception->getMessage()], 500);
    }

    // @extends
    public function register() {
        $this->reportable(function (Throwable $e) {
            if (app()->bound('sentry')) {
                app('sentry')->captureException($e);
            }
        });
    }
}
