<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; 
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Exception; 
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
                return redirect()->route('login');
            };
        });
    }

    public function render($request, Throwable $exception)
    {
        // Handle all exceptions here
        if ($request->is('api/*')) {
            if ($exception instanceof HttpResponseException) {
                return $exception->getResponse();
            }
    
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                return response()->json([
                    'success'   => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message'   => 'Validation errors',
                    'data'      => $exception->validator->errors(),
                ]);
            }

            return response()->json([
                'message' => 'An error occurred while processing the request.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return redirect()
            ->back() // Redirect back to the previous page
            ->withErrors($exception->validator->getMessageBag()) // Pass the validation errors
            ->withInput(); // Keep the old input data 
        }
        $exception = config('app.env') === 'local' ? $exception->getMessage() : 'Please contact to admin';
        return view('error',compact('exception'));
    }
}
