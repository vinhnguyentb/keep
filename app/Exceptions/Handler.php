<?php

namespace Keep\Exceptions;

use Bugsnag;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Bugsnag\BugsnagLaravel\BugsnagExceptionHandler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $e
     */
    public function report(Exception $e)
    {
        if (auth()->check()) {
            Bugsnag::setUser([
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ]);
        }

        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        switch (class_basename($e)) {
            case 'InvalidUserException':
                flash()->warning($e->getMessage());
                return redirect()->home();

            case 'InvalidRolesException':
                flash()->warning($e->getMessage());
                return redirect()->home();

            case 'NotFoundHttpException':
                flash()->warning(trans('exception.not_found_http_exception'));
                return redirect()->home();
        };

        return parent::render($request, $e);
    }
}
