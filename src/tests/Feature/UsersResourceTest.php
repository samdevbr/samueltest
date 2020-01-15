<?php
namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Mockery\MockInterface;
use Illuminate\Support\Str;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;

class UsersResourceTest extends TestCase
{
	use DatabaseMigrations;

	/**
	 * @var MockInterface $mock
	 */
	protected $mock;

	protected function setUp(): void
	{
		parent::setUp();

		$this->mock = $this->mockInstance(UserService::class);
	}

	public function testUserListWithoutUsers()
	{
		$this->mock->expects('all')->andReturn([]);

		$this->call('GET', '/users')
			->assertStatus(Response::HTTP_OK)
			->assertJsonCount(0);
	}

	public function testUserGet()
	{
		$id = Str::uuid();
		$user = [
			"_id" => $id,
			"name" => "Dr. Kade O'Conner Sr.",
			"email" => "fbatz@example.com",
			"updated_at" => "2020-01-15 18:37:06",
			"created_at" => "2020-01-15 18:37:06"
		];

		$this->mock->expects('getById')->andReturn($user);

		$this->call('GET', '/users/' . $id)
			->assertStatus(Response::HTTP_OK)
			->assertExactJson($user);
	}

	public function testUserListWihtUsers()
	{
		$users = factory(User::class, 10)->make([
			'updated_at' => Carbon::now(),
			'created_at' => Carbon::now()
		]);

		$this->mock->expects('all')->andReturn($users);

		$expectedResponse = collect($users)->map(function ($user) {
			$user = clone $user;
			return $user->setHidden(['password'])->toArray();
		})->toArray();

		$this->call('GET', '/users')
			->assertStatus(Response::HTTP_OK)
			->assertExactJson($expectedResponse);
	}

	public function testUserCreate()
	{
		$user = [
			'name' => 'Samuel Oliveira',
			'email' => 'samueldevbr@gmail.com'
		];

		$this->mock->expects('insert');

		$this->call('POST', '/users', $user)
			->assertStatus(Response::HTTP_OK)
			->assertExactJson([]);

		$user['email'] = null;
		$user['name'] = null;

		$this->call('POST', '/users', $user)
			->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
	}

	public function testUserUpdate()
	{
		$identifier = Str::uuid();
		$data = [
			'name' => 'Samuel',
			'email' => 'samueldevbr@gmail.com'
		];

		$this->mock->expects('update');

		$this->call('PUT', '/users/' . $identifier, $data)
			->assertStatus(Response::HTTP_OK)
			->assertExactJson([]);
	}

	public function testUserDelete()
	{
		$identifier = Str::uuid();

		$this->mock->expects('delete');

		$this->call('DELETE', '/users/' . $identifier)
			->assertStatus(Response::HTTP_OK)
			->assertExactJson([]);
	}

	public function testWrongUri()
	{
		$this->call('GET', '/ussers')
			->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
			->assertJsonStructure([
				'error'
			]);
	}
}
