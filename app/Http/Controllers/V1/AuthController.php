<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Constants\CacheKey;
use App\Utils\Snowflake;
use Illuminate\Http\Response;
use App\Http\Responses\V1\LoginResponse;

/**
 * @OA\Tag(
 *     name="Auth Moudle",
 * )
 */
class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/v1/send-code",
     *     summary="Send Verification Code",
     *     tags={"Auth Moudle"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SendVerifyCodeRequest")
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
    public function sendVerifyCode(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'string', 'regex:/^1[3-9]\d{9}$/'],
        ]);
        if ($validator->fails()) {
            return $this->err($validator->errors()->first());
        }
        $phone = $request->input('phone');
        $cacheKey = CacheKey::SMS_CODE . $phone;
        $lockKey = CacheKey::SMS_SEND_LOCK . $phone;
        if (Cache::has($lockKey)) {
            return $this->err(httpStatus: Response::HTTP_UNAUTHORIZED);
        }
        $code = rand(1000, 9999);
        Cache::put($cacheKey, $code, now()->addMinutes(1));
        Cache::put($lockKey, true, now()->addMinutes(1));
        # TODO fake send
        return $this->ok();
    }

    /**
     * @OA\Post(
     *     path="/v1/login",
     *     summary="User Registration/Login",
     *     tags={"Auth Moudle"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful Response",
     *         @OA\JsonContent(ref="#/components/schemas/LoginResponse")
     *     )
     * )
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $phone = $request->input('phone');
        $code = $request->input('code');
        $cacheKey = CacheKey::SMS_CODE . $phone;
        $cachedCode = Cache::get($cacheKey);
        if (!$cachedCode || $cachedCode !== $code) {
            return $this->err(httpStatus: Response::HTTP_UNAUTHORIZED);
        }
        $user = User::where('phone', $phone)->first();
        if (!$user) {
            $userno = $this->getNextUno();
            $snowflake = new Snowflake(1);
            $usercode = $snowflake->generateId();
            $clientip = $request->ip();
            $user = User::create([
                'userno' => $userno,
                'usercode' => $usercode,
                'phone' => $phone,
                'client_ip' => $clientip,
                'login_at' => now(),
                'login_token' => $this->generateToken($user),
                'nickname' => 'SUGAR_' . substr($phone, -4),
            ]);
        } else {
            $user->update([
                'login_at' => now(),
                'client_ip' => $request->ip(),
                'login_token' => $this->generateToken($user),
            ]);
        }
        return $this->ok(new LoginResponse($$user->login_token));
    }

    /**
     * @OA\Post(
     *     path="/v1/logout",
     *     summary="User Logout",
     *     tags={"Auth Moudle"},
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
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return $this->ok();
    }

    protected function getNextUno(): int
    {
        if (!Cache::has(CacheKey::NEXT_UNO)) {
            Cache::put(CacheKey::NEXT_UNO, 100000);
        }
        return Cache::increment(CacheKey::NEXT_UNO);
    }

    protected function generateToken(User $user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }
}
