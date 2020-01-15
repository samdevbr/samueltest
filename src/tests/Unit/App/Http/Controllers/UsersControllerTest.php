<?php
namespace Tests\Unit\App\Http\Controllers;

use Tests\TestCase;
use App\Http\Controllers\UsersController;

class UsersControllerTest extends TestCase
{
	public function testClassHasRequiredMethods()
	{
		$this->assertTrue(method_exists(UsersController::class,'onList'));

		$this->assertTrue(method_exists(UsersController::class,'beforeCreate'));
		$this->assertTrue(method_exists(UsersController::class,'onCreate'));

		$this->assertTrue(method_exists(UsersController::class,'beforeGet'));
		$this->assertTrue(method_exists(UsersController::class,'onGet'));

		$this->assertTrue(method_exists(UsersController::class,'beforeUpdate'));
		$this->assertTrue(method_exists(UsersController::class,'onUpdate'));

		$this->assertTrue(method_exists(UsersController::class,'beforeDelete'));
		$this->assertTrue(method_exists(UsersController::class,'onDelete'));
	}
}
