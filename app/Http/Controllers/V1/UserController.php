<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\V1\UpdateUserRequest;
use App\Http\Responses\V1\GetUserResponse;
use App\Models\User;
use Carbon\Carbon;


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
        $userCode = $request->route('user_code');

        if ($userCode) {
            $user = User::where('user_code', $userCode)->first();
            if (!$user) {
                return $this->err('User not found');
            }
        } else {
            $user = $request->user();
        }
        $getUserResponse = new GetUserResponse(
            $user->user_code,
            $user->user_no,
            $user->nickname,
            $user->email,
            $user->phone
        );
        return $this->ok($getUserResponse);
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
    public function update(UpdateUserRequest $request): JsonResponse
    {
        $user = $request->user();
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
        $user->status = 3;
        $user->deleted_at = Carbon::now();
        $user->save();
        return $this->ok();
    }
}
