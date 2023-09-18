<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use App\Exceptions\GeneralException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;
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
     * Determine if the exception handler response should be JSON.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return bool
     */
    protected function shouldReturnJson($request, Throwable $e)
    {
        return true;
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->generalisedResponse('Unauthorised', false, '', 400);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        // dd("I am here");
        $this->renderable(function (ValidationException $e) {
            return $this->generalisedResponse("Validation failed", false, ['errors' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        });
        $this->renderable(function (GeneralException $e) {
            return $this->generalisedResponse($e->getMessage(), false, '', $e->getCode());
        });
        $this->renderable(function (AuthenticationException $e) {
            return $this->generalisedResponse("Unauthenticated", false, '', Response::HTTP_UNAUTHORIZED);
        });
        $this->renderable(function (AuthorizationException $e) {
            return $this->generalisedResponse($e->getMessage(), false, '', $e->getCode());
        });
        $this->reportable(function (Throwable $e) {
            return $this->generalisedResponse("Internal Server", false, '', Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    }
}
