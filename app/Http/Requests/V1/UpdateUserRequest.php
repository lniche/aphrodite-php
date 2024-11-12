<?php

namespace App\Http\Requests\V1;

use OpenApi\Annotations as OA;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UpdateUserRequest",
 *     type="object"
 * )
 */
class UpdateUserRequest extends FormRequest
{
    /**
     * @OA\Property(
     *     description="User Nickname",
     *     example="john"
     * )
     */
    public string $nickname;

    /**
     * @OA\Property(
     *     description="User Email",
     *     example="john@example.com"
     * )
     */
    public string $email;


    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nickname' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
        ];
    }
}
