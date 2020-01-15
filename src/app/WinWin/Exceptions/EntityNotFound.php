<?php
namespace App\WinWin\Exceptions;

use Illuminate\Http\Response;

class EntityNotFound extends ApiException
{
	public $statusCode = Response::HTTP_NOT_FOUND;
	public $message = 'Requested entity couldn\'t be found or does not exist';
}
