<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Traits\RestController;
use App\Services\IUserService;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class UsersController
{
	use RestController, ValidatesRequests;

	/**
	 * @var IUserService $userService;
	 */
	protected $userService;

	public function __construct(IUserService $userService)
	{
		$this->userService = $userService;
	}

	protected function onList(Request $request)
	{
		return $this->userService->all();
	}

	protected function onGet(Request $request, $identifer)
	{
		return $this->userService->getById($identifer);
	}

	protected function beforeCreate(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email|unique:users,email'
		]);
	}

	protected function onCreate(Request $request)
	{
		return $this->userService->insert($request->all());
	}

	protected function beforeUpdate(Request $request, $identifer)
	{
		$this->validate($request, [
			'name' => 'required',
			'email' => 'required|email|unique:users,email,' . $identifer . ',_id'
		]);
	}

	protected function onUpdate(Request $request, $identifer)
	{
		return $this->userService->update($identifer, $request->all());
	}

	protected function onDelete(Request $request, $identifer)
	{
		$this->userService->delete($identifer);
	}
}
