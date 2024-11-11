<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *     name="User",
 * )
 */
class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/v1/user/",
     *     tags={"User"},
     *     summary="User Info",
     *     @OA\Response(
     *         response=200,
     *         description="Successful Response",
     *         @OA\JsonContent(
     *             @OA\Property(property="user_code", type="string", example="A8000"),
     *             @OA\Property(property="user_no", type="integer", example=10000),
     *             @OA\Property(property="nickname", type="string", example="john"),
     *             @OA\Property(property="email", type="string", example="john@example.com"),
     *             @OA\Property(property="phone", type="string", example="13800138000")
     *         )
     *     )
     * )
     */
    public function get(Request $request): JsonResponse
    {
        $user = $request->user();
        return $this->ok([
            'user_code' => $user->user_code,
            'user_no' => $user->user_no,
            'nickname' => $user->nickname,
            'email' => $user->email,
            'phone' => $user->phone,
        ]);
    }

    /**
     * @OA\Put(
     *     path="/v1/user/",
     *     tags={"User"},
     *     summary="Update User",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nickname", type="string", example="john"),
     *             @OA\Property(property="email", type="string", example="john@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful Response",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", type="integer", example="0")
     *             @OA\Property(property="message", type="string", example="ok")
     *             @OA\Property(property="data",  example="ok")
     *         )
     *     )
     * )
     */
    public function update(Request $request): JsonResponse
    {
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'nickname' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email'
        ]);
        if ($validator->fails()) {
            return $this->err($validator->errors()->first());
        }
        if ($request->filled('nickname')) {
            $user->nickname = $request->input('nickname');
        }
        if ($request->filled('email')) {
            $user->email = $request->input('email');
        }
        $user->save();
        return $this->ok();
    }

    /**
     * @OA\Delete(
     *     path="/v1/user/",
     *     tags={"User"},
     *     summary="Delete User",
     *     operationId="deleteUser",
     *     @OA\Response(
     *         response=200,
     *         description="Successful Response",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User deleted successfully")
     *         )
     *     )
     * )
     */
    public function delete(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->delete();
        return $this->ok();
    }
}
