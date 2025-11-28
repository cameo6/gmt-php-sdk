<?php

declare(strict_types=1);

namespace Gmt\Purchases\PurchaseRequestVerificationCodeResponse;

use Gmt\Core\Attributes\Api;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * **Verification Credentials.** Login credentials for the purchased Telegram account. Initially `null` after purchase creation.
 *
 * **Availability.** Populated after calling `POST /purchases/:id/request-code`. Once received, credentials are permanent and cannot be re-requested.
 *
 * **Security.** Verification data is only visible to the purchase owner.
 *
 * @phpstan-type VerificationShape = array{
 *   code: string, password: string, received_at: string
 * }
 */
final class Verification implements BaseModel
{
    /** @use SdkModel<VerificationShape> */
    use SdkModel;

    /**
     * Verification code for account.
     */
    #[Api]
    public string $code;

    /**
     * Account password.
     */
    #[Api]
    public string $password;

    /**
     * **Code Retrieval Timestamp.** Marks when verification code was successfully fetched from the provider (not when purchase was created).
     *
     * **Example timeline.**
     * - `created_at`: `2024-11-19T10:00:00Z` (purchase created)
     * - `received_at`: `2024-11-19T10:05:02Z` (code requested 5 minutes later)
     *
     * **Note.** These timestamps may be identical if code is requested immediately after purchase.
     */
    #[Api]
    public string $received_at;

    /**
     * `new Verification()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Verification::with(code: ..., password: ..., received_at: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Verification)->withCode(...)->withPassword(...)->withReceivedAt(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $code,
        string $password,
        string $received_at
    ): self {
        $obj = new self;

        $obj->code = $code;
        $obj->password = $password;
        $obj->received_at = $received_at;

        return $obj;
    }

    /**
     * Verification code for account.
     */
    public function withCode(string $code): self
    {
        $obj = clone $this;
        $obj->code = $code;

        return $obj;
    }

    /**
     * Account password.
     */
    public function withPassword(string $password): self
    {
        $obj = clone $this;
        $obj->password = $password;

        return $obj;
    }

    /**
     * **Code Retrieval Timestamp.** Marks when verification code was successfully fetched from the provider (not when purchase was created).
     *
     * **Example timeline.**
     * - `created_at`: `2024-11-19T10:00:00Z` (purchase created)
     * - `received_at`: `2024-11-19T10:05:02Z` (code requested 5 minutes later)
     *
     * **Note.** These timestamps may be identical if code is requested immediately after purchase.
     */
    public function withReceivedAt(string $receivedAt): self
    {
        $obj = clone $this;
        $obj->received_at = $receivedAt;

        return $obj;
    }
}
