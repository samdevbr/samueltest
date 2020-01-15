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

	/**
     * @OA\Get(
     *     path="/users",
     *     summary="Returns all users.",
     *     operationId="onList",
     *     @OA\Response(
     *        response=200,
     *        description="Returns all users.",
     *        @OA\JsonContent(
     *          type="array",
     *          @OA\Items(properties={
	 * 				@OA\Property(property="_id", type="string"),
	 * 				@OA\Property(property="name", type="string"),
	 * 				@OA\Property(property="email", type="string"),
	 * 				@OA\Property(property="updated_at", type="string"),
	 * 				@OA\Property(property="created_at", type="string"),
	 * 			})
     *        )
     *     )
     * )
     */
	protected function onList(Request $request)
	{
		return $this->userService->all();
	}

	/**
     * @OA\Get(
     *     path="/users/{id}",
	 *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User id",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     summary="Returns an specific user by it's id.",
     *     operationId="onGet",
     *     @OA\Response(
     *        response=200,
     *        description="Returns an specific user by it's id.",
     *        @OA\JsonContent(
     *          type="array",
     *          @OA\Items(properties={
	 * 				@OA\Property(property="_id", type="string"),
	 * 				@OA\Property(property="name", type="string"),
	 * 				@OA\Property(property="email", type="string"),
	 * 				@OA\Property(property="updated_at", type="string"),
	 * 				@OA\Property(property="created_at", type="string"),
	 * 			})
     *        )
     *     ),
	 *     @OA\Response(
	 * 	       response=404,
	 * 		   description="User not found",
	 * 		   @OA\JsonContent(
	 *		     type="object",
	 *           properties={
	 *              @OA\Property(property="error", type="string")
	 *           }
	 *         )
	 * 	   )
     * )
     */
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

     /**
     * @OA\Post(
     *     path="/users",
     *     summary="Creates an user.",
     *     operationId="onCreate",
	 *     requestBody=@OA\RequestBody(
	 *     	   required=true,
	 *         request="Create user",
	 *         @OA\JsonContent(
	 *             type="object",
	 *             properties={
	 *                 @OA\Property(property="name", type="string"),
	 * 				   @OA\Property(property="email", type="string")
	 *             } 
	 *         )
	 *     ),
     *     @OA\Response(
     *        response=200,
     *        description="Creates an user.",
     *        @OA\JsonContent(
     *          type="object",
     *          properties={
	 * 				@OA\Property(property="_id", type="string"),
	 * 				@OA\Property(property="name", type="string"),
	 * 				@OA\Property(property="email", type="string"),
	 * 				@OA\Property(property="updated_at", type="string"),
	 * 				@OA\Property(property="created_at", type="string"),
	 * 			}
     *        )
     *     ),
	 *     @OA\Response(
	 * 	       response=422,
	 * 		   description="Request payload not valid",
	 * 		   @OA\JsonContent(
	 *		     type="object",
	 *           properties={
	 *              @OA\Property(property="error", type="string")
	 *           }
	 *         )
	 * 	   )
     * )
     */
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

     /**
     * @OA\Put(
     *     path="/users/{id}",
	 * 	   @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User id",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     summary="Updates a user.",
     *     operationId="onUpdate",
	 *     requestBody=@OA\RequestBody(
	 *     	   required=true,
	 *         request="Update user",
	 *         @OA\JsonContent(
	 *             type="object",
	 *             properties={
	 *                 @OA\Property(property="name", type="string"),
	 * 				   @OA\Property(property="email", type="string")
	 *             } 
	 *         )
	 *     ),
     *     @OA\Response(
     *        response=200,
     *        description="User updated.",
     *        @OA\JsonContent(
     *          type="object",
     *          properties={
	 * 				@OA\Property(property="_id", type="string"),
	 * 				@OA\Property(property="name", type="string"),
	 * 				@OA\Property(property="email", type="string"),
	 * 				@OA\Property(property="updated_at", type="string"),
	 * 				@OA\Property(property="created_at", type="string"),
	 * 			}
     *        )
     *     ),
	 *     @OA\Response(
	 * 	       response=422,
	 * 		   description="Request payload not valid",
	 * 		   @OA\JsonContent(
	 *		     type="object",
	 *           properties={
	 *              @OA\Property(property="error", type="string")
	 *           }
	 *         )
	 * 	   ),
	 * 	   @OA\Response(
	 * 	       response=404,
	 * 		   description="User not found",
	 * 		   @OA\JsonContent(
	 *		     type="object",
	 *           properties={
	 *              @OA\Property(property="error", type="string")
	 *           }
	 *         )
	 * 	   )
     * )
     */
	protected function onUpdate(Request $request, $identifer)
	{
		return $this->userService->update($identifer, $request->all());
	}

     /**
     * @OA\Delete(
     *     path="/users/{id}",
	 * 	   @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User id",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     summary="Deletes a user.",
     *     operationId="onDelete",
     *     @OA\Response(
     *        response=200,
     *        description="User deleted.",
     *        @OA\JsonContent(
     *          type="object",
     *          properties={}
     *        )
     *     ),
	 * 	   @OA\Response(
	 * 	       response=404,
	 * 		   description="User not found",
	 * 		   @OA\JsonContent(
	 *		     type="object",
	 *           properties={
	 *              @OA\Property(property="error", type="string")
	 *           }
	 *         )
	 * 	   )
     * )
     */
	protected function onDelete(Request $request, $identifer)
	{
		$this->userService->delete($identifer);
	}
}
