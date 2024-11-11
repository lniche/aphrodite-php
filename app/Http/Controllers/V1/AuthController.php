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

/**
 * @OA\Tag(
 *     name="Auth",
 * )
 */
class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/v1/send-code",
     *     tags={"Auth"},
     *     summary="Send Verification Code",
     *     @OA\Parameter(
     *         name="phone",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string", example="13800138000")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful Response",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Code sent successfully")
     *         )
     *     )
     * )
     */
    public function sendCode(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'string', 'regex:/^1[3-9]\d{9}$/'],
        ]);
        if ($validator->fails()) {
            return $this->err($validator->errors()->first());
        }
        $phone = $request->input('phone');
        $cacheKey = CacheKey::SMS_VERIFICATION . $phone;
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
     *     tags={"Auth"},
     *     summary="User Registration/Login",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"phone", "code"},
     *             @OA\Property(property="phone", type="string", example="13800138000"),
     *             @OA\Property(property="code", type="string", example="1234")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful Response",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="your_token_here"),
     *             @OA\Property(property="token_type", type="string", example="Bearer")
     *         )
     *     )
     * )
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $phone = $request->input('phone');
        $code = $request->input('code');
        $cacheKey = CacheKey::SMS_VERIFICATION . $phone;
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
                'logintoken' => $this->generateToken($user),
                'nickname' => 'SUGAR_' . substr($phone, -4),
            ]);
        } else {
            $user->update([
                'login_at' => now(),
                'client_ip' => $request->ip(),
                'logintoken' => $this->generateToken($user),
            ]);
        }
        return $this->ok([
            'token' => $user->logintoken,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * @OA\Post(
     *     path="/v1/logout",
     *     tags={"Auth"},
     *     summary="User Logout",
     *     @OA\Response(
     *         response=200,
     *         description="Successful Response",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Logged out successfully")
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
