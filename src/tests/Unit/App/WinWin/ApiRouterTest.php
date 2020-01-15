<?php
namespace Tests\Unit\App\WinWin;

use App\WinWin\ApiRouter;
use Illuminate\Support\Arr;
use Tests\TestCase;

class ApiRouterTest extends TestCase
{
	public function testGetControllerForUri()
	{
		$uri = 'users';
		$expected = 'UsersController';
		$notExpected = 'usersController';

		$actual = ApiRouter::getControllerForUri($uri);

		$this->assertEquals($expected, $actual);
		$this->assertNotEquals($notExpected, $actual);

		$uri = 'any-uri';
		$expected = 'AnyUriController';
		$notExpected = 'AnyuriController';

		$actual = ApiRouter::getControllerForUri($uri);

		$this->assertEquals($expected, $actual);
		$this->assertNotEquals($notExpected, $actual);
	}

	public function testResourceMethodExists()
	{
		$this->assertTrue(method_exists(ApiRouter::class, 'resource'));
	}
}
