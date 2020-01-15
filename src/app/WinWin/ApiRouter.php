<?php
namespace App\WinWin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

class ApiRouter
{
	public static function getControllerForUri(string $uri)
	{
		return Str::studly($uri) . 'Controller';
	}

	public static function resource(string $uri, array $middlewares = [])
	{
		$controller = static::getControllerForUri($uri);

		Route::group([
			'prefix' => $uri,
			'middleware' => $middlewares
		], function() use ($controller) {
			Route::get('/', $controller . '@list');
			Route::post('/', $controller . '@create');
			Route::get('/{identifer}', $controller . '@get');
			Route::put('/{identifer}', $controller . '@update');
			Route::delete('/{identifer}', $controller . '@delete');
		});
	}
}
