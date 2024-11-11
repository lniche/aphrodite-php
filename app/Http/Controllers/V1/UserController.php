<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class UserController extends Controller
{

    public function get(Request $request): JsonResponse
    {
        return $this->respond();
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        event(new Registered($user));

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->respond([
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        return $this->ok();
    }

    public function delete(Request $request): JsonResponse
    {
        return $this->ok();
    }
}
