<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
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
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        // dd("I am here");
        $this->renderable(function (ValidationException $e) {
            return $this->generalisedResponse("Validation failed", false, ['errors' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        });
        $this->reportable(function (Throwable $e) {
            dd("I am here");
        });
    }
}
