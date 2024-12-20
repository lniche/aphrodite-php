<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="LoginRequest",
 *     type="object",
 *     required={"phone", "code"},
 *     @OA\Property(
 *         property="phone",
 *         type="string",
 *         example="13800138000",
 *         description="User Phone"
 *     ),
 *     @OA\Property(
 *         property="code",
 *         type="string",
 *         example="1234",
 *         description="Verification code",
 *         minLength=4,
 *         maxLength=4
 *     )
 * )
 */
class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => ['required', 'string', 'regex:/^1[3-9]\d{9}$/'],
            'code' => ['required', 'string', 'min:4', 'max:4'],
        ];
    }
}
