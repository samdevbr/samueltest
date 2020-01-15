<?php
namespace App\WinWin\Exceptions;

use Illuminate\Http\Response;

class NotImplementedMethod extends ApiException
{
	public $statusCode = Response::HTTP_NOT_IMPLEMENTED;
	public $message = 'Requested method is not implemented';
}
