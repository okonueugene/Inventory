<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
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
            $this->renderable(function (NotFoundHttpException $e, $request) {
                if($request->wantsJson()) {
                    return response()->json([
                        'message' => 'Object Not Found',
                        'status'  => 404,
                    ]);
                }
            });
        });
    }

    /**
     * Render an exception into an HTTP response.
     */

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof TokenMismatchException) {
        
                // User is not authenticated, redirect to the login page
                return redirect()->route('login')->withErrors([
                    'message' => 'CSRF token mismatch. Please log in again.',
                ]);
            
        }

        if ($exception instanceof NotFoundHttpException) {
            return redirect()->route('login')->withErrors(['message' => 'Object Not Found']);
        }

        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            $this->renderable(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, $request) {
                return redirect()->route('login')->withErrors(['message' => 'You are not authorized to access this page.']);
            });
        }
        // Add handling for TransportException here
        if ($exception instanceof \Swift_TransportException) {
            return redirect()->route('login')->withErrors(['message' => 'Email not sent.']);

        }
        if ($exception instanceof \Symfony\Component\Mailer\Exception\TransportException) {
            //go to login page
            return redirect()->route('login')->withErrors(['message' => 'Email not sent.']);
        }

        return parent::render($request, $exception);
    }


}
