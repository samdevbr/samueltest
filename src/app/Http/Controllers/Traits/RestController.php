<?php
namespace App\Http\Controllers\Traits;

use App\WinWin\Exceptions\NotImplementedMethod;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait RestController
{
	protected function beforeList(Request $request)
	{
		// 
	}

	protected function onList(Request $request)
	{
		throw new NotImplementedMethod;
	}

	public function list(Request $request)
	{
		$this->beforeList($request);

		$response = $this->onList($request);

		return response()->json($response);
	}

	protected function beforeCreate(Request $request)
	{
		// 
	}

	protected function onCreate(Request $request)
	{
		throw new NotImplementedMethod;
	}

	public function create(Request $request)
	{
		$this->beforeCreate($request);

		$entity = $this->onCreate($request);

		return response()->json($entity, Response::HTTP_CREATED);
	}

	protected function beforeGet(Request $request, $identifer)
	{
		// 
	}

	protected function onGet(Request $request, $identifer)
	{
		throw new NotImplementedMethod;
	}

	public function get(Request $request, $identifer)
	{
		$this->beforeGet($request, $identifer);

		$response = $this->onGet($request, $identifer);

		return response()->json($response);
	}

	protected function beforeUpdate(Request $request, $identifer)
	{
		// 
	}

	protected function onUpdate(Request $request, $identifer)
	{
		throw new NotImplementedMethod;
	}

	public function update(Request $request, $identifer)
	{
		$this->beforeUpdate($request, $identifer);

		$this->onUpdate($request, $identifer);

		return response()->json(null, Response::HTTP_NO_CONTENT);
	}

	protected function beforeDelete(Request $request, $identifer)
	{
		// 
	}

	protected function onDelete(Request $request, $identifer)
	{
		throw new NotImplementedMethod;
	}

	public function delete(Request $request, $identifer)
	{
		$this->beforeDelete($request, $identifer);

		$this->onDelete($request, $identifer);

		return response()->json(null, Response::HTTP_NO_CONTENT);
	}
}
