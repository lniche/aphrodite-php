<?php

namespace App\Http\Responses\V1;

/**
 * @OA\Schema(
 *     schema="LoginResponse",
 *     type="object",
 *     required={"assessToken"},
 *     @OA\Property(
 *         property="assessToken",
 *         type="string",
 *         example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
 *         description="Access token"
 *     )
 * )
 */
class LoginResponse
{

    public string $assessToken;

    public function __construct(string $assessToken)
    {
        $this->assessToken = $assessToken;
    }

    public function toArray(): array
    {
        return [
            'assessToken' => $this->assessToken,
        ];
    }
}
