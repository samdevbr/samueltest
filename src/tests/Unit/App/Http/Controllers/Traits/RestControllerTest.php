<?php
namespace Tests\Unit\App\Http\Controllers\Traits;

use Tests\TestCase;
use App\Http\Controllers\Traits\RestController;

class RestControllerTest extends TestCase
{
	public function testTraitExists()
	{
		$this->assertTrue(trait_exists(RestController::class, true));
	}

	public function testTraitHasRequiredMethods()
	{
		$this->assertTrue(method_exists(RestController::class,'beforeList'));
		$this->assertTrue(method_exists(RestController::class,'onList'));
		$this->assertTrue(method_exists(RestController::class,'list'));

		$this->assertTrue(method_exists(RestController::class,'beforeCreate'));
		$this->assertTrue(method_exists(RestController::class,'onCreate'));
		$this->assertTrue(method_exists(RestController::class,'create'));

		$this->assertTrue(method_exists(RestController::class,'beforeGet'));
		$this->assertTrue(method_exists(RestController::class,'onGet'));
		$this->assertTrue(method_exists(RestController::class,'get'));

		$this->assertTrue(method_exists(RestController::class,'beforeUpdate'));
		$this->assertTrue(method_exists(RestController::class,'onUpdate'));
		$this->assertTrue(method_exists(RestController::class,'update'));

		$this->assertTrue(method_exists(RestController::class,'beforeDelete'));
		$this->assertTrue(method_exists(RestController::class,'onDelete'));
		$this->assertTrue(method_exists(RestController::class,'delete'));
	}
}
