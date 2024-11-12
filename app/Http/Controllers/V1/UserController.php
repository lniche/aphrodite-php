<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *     name="User Moudle",
 * )
 */
class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/v1/user",
     *     summary="User Info",
     *     tags={"User Moudle"},
     *     security={{"Authorization": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful Response",
     *         @OA\JsonContent(ref="#/components/schemas/GetUserResponse")
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
     *     path="/v1/user",
     *     summary="Update User",
     *     tags={"User Moudle"},
     *     security={{"Authorization": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateUserRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful Response",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", type="integer", example="0"),
     *             @OA\Property(property="message", type="string", example="ok"),
     *             @OA\Property(property="data", type="object")
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
     *     path="/v1/user",
     *     summary="Delete User",
     *     tags={"User Moudle"},
     *     security={{"Authorization": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful Response",
     *         @OA\JsonContent(
     *             @OA\Property(property="code", type="integer", example="0"),
     *             @OA\Property(property="message", type="string", example="ok"),
     *             @OA\Property(property="data", type="object")
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
