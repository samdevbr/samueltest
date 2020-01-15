<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Traits\RestController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class UsersController
{
	use RestController, ValidatesRequests;

	protected function onList(Request $request)
	{
		return [];
	}
}
