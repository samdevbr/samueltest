<?php
namespace Tests\Unit\App\WinWin;

use App\WinWin\Router;
use Tests\TestCase;

class RouterTest extends TestCase
{
	/**
	 * @var Router $router
	 */
	protected $router;

	protected function setUp(): void
	{
		parent::setUp();

		$this->router = app()->make(Router::class);
	}

	public function testGetControllerForUri()
	{
		$uri = 'users';
		$expected = 'UsersController';
		$notExpected = 'usersController';

		$actual = $this->router->getControllerForUri($uri);

		$this->assertEquals($expected, $actual);
		$this->assertNotEquals($notExpected, $actual);
	}
}
