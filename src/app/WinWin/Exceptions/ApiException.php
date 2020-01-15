<?php
namespace App\WinWin\Exceptions;

use Exception;
use Illuminate\Http\Response;

abstract class ApiException extends Exception
{
	public $message = 'Unexpceted error';
	public $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
}