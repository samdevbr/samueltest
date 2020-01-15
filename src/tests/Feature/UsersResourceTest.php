<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;

class UsersResourceTest extends TestCase
{
	public function testUserList()
	{
		$this->call('GET', '/users')
			->assertStatus(Response::HTTP_OK)
			->assertExactJson([]);
	}
}
