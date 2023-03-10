<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'message' => __('Los datos proporcionados no son válidos.'),
            'errors' => $exception->errors(),
        ], $exception->status);
    }
     public function render($request, Throwable $exception)
    {
        if($exception instanceof ModelNotFoundException){
            return response()->json(["res" => false, "error" => "Error modelo no encontrado"], 400);
        }
        if($exception instanceof RouteNotFoundException){
            return response()->json(["res" => false, "error" => "No tiene permiso a esta ruta"], 401);
        }
        return parent::render($request, $exception);
    }
}
