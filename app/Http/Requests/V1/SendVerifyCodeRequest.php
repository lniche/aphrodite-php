<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="SendVerifyCodeRequest",
 *     type="object",
 *     required={"phone"},
 *     @OA\Property(
 *         property="phone",
 *         type="string",
 *         example="13800138000",
 *         description="User Phone"
 *     )
 * )
 */
class SendVerifyCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => ['required', 'string', 'regex:/^1[3-9]\d{9}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'Phone number cannot be empty',
            'phone.regex' => 'Verification code cannot be empty',
        ];
    }
}
