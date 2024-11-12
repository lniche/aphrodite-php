<?php

namespace App\Http\Responses\V1;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="GetUserResponse",
 *     type="object"
 * )
 */
class GetUserResponse
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
     *     description="User Number",
     *     example="A8000"
     * )
     */
    public int $userNo;

    /**
     * @OA\Property(
     *     description="User Code",
     *     example="100000"
     * )
     */
    public string $userCode;

    /**
     * @OA\Property(
     *     description="User Email",
     *     example="john@example.com"
     * )
     */
    public string $email;

    /**
     * @OA\Property(
     *     description="User Phone",
     *     example="13800138000"
     * )
     */
    public string $phone;

    public function __construct(
        ?string $nickname = null,
        ?int $userNo = null,
        ?string $userCode = null,
        ?string $email = null,
        ?string $phone = null
    ) {
        $this->nickname = $nickname;
        $this->userNo = $userNo;
        $this->userCode = $userCode;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function toArray(): array
    {
        return [
            'nickname' => $this->nickname,
            'userNo' => $this->userNo,
            'userCode' => $this->userCode,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }
}
