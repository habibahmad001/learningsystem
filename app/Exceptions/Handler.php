<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @return void
     *
     * @throws \Throwable
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





        // return parent::render($request, $exception);
        if ($exception instanceof HttpExceptionInterface) {
            $data['key'] = 'Page '.$exception->getStatusCode();

            $data['active_class'] = 'Error '.$exception->getStatusCode();

            if ($exception->getStatusCode() == 404) {
                $view_name = getTheme().'::errors.404';
                return response()->view($view_name,$data);
            }
            else if ($exception->getStatusCode() == 401) {
                $view_name = getTheme().'::errors.500';
                return response()->view($view_name,$data);
            }
            else if ($exception->getStatusCode() == 500) {
                $view_name = getTheme().'::errors.500';
                return response()->view($view_name,$data);
            }else{
                $view_name = getTheme().'::errors.404';
                return response()->view($view_name,$data);
            }
        }



       /* if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 404) {
                $view_name = getTheme().'::errors.404';
                return response()->view($view_name,$data);
            }
            if ($exception->getStatusCode() == 401) {
                $view_name = getTheme().'::errors.401';
                return response()->view($view_name,$data);
            }
            if ($exception->getStatusCode() == 500) {
                $view_name = getTheme().'::errors.500';
                return response()->view($view_name,$data);
            }
        }*/
        return parent::render($request, $exception);
    }



}