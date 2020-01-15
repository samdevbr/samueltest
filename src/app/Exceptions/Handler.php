<?php

namespace App\Exceptions;

use App\WinWin\Exceptions\ApiException;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
		// report to newrelic ?
	}

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
		if ($exception instanceof ApiException) {
			return response()->json([
				'error' => $exception->message
			], $exception->statusCode);
        } else if ($exception instanceof ValidationException) {
            return response()->json([
				'error' => $exception->getMessage()
			], $exception->status);
        }

		$error = app()->environment() === 'production' ? 'Unexpceted error' : $exception->getMessage();

        return response()->json([
			'error' => $error
		], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
