<?php

declare(strict_types=1);

namespace Gmt\Purchases;

use Gmt\Core\Attributes\Api;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\CodeRequest;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\CodeRequest\Status;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\Purchase;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\Purchase\DisplayName;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\Purchase\Price;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\Purchase\Verification;

/**
 * @phpstan-type PurchaseRequestVerificationCodeResponseShape = array{
 *   code_request: CodeRequest, purchase: Purchase
 * }
 */
final class PurchaseRequestVerificationCodeResponse implements BaseModel
{
    /** @use SdkModel<PurchaseRequestVerificationCodeResponseShape> */
    use SdkModel;

    #[Api]
    public CodeRequest $code_request;

    #[Api]
    public Purchase $purchase;

    /**
     * `new PurchaseRequestVerificationCodeResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchaseRequestVerificationCodeResponse::with(code_request: ..., purchase: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurchaseRequestVerificationCodeResponse)
     *   ->withCodeRequest(...)
     *   ->withPurchase(...)
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
     *
     * @param CodeRequest|array{
     *   attempt: int,
     *   max_attempts: int,
     *   next_attempt_at: string|null,
     *   retry_after: int|null,
     *   status: value-of<Status>,
     * } $code_request
     * @param Purchase|array{
     *   id: int,
     *   country_code: string,
     *   created_at: string,
     *   display_name: DisplayName,
     *   phone_number: string,
     *   price: Price,
     *   status: value-of<Purchase\Status>,
     *   verification: Verification|null,
     * } $purchase
     */
    public static function with(
        CodeRequest|array $code_request,
        Purchase|array $purchase
    ): self {
        $obj = new self;

        $obj['code_request'] = $code_request;
        $obj['purchase'] = $purchase;

        return $obj;
    }

    /**
     * @param CodeRequest|array{
     *   attempt: int,
     *   max_attempts: int,
     *   next_attempt_at: string|null,
     *   retry_after: int|null,
     *   status: value-of<Status>,
     * } $codeRequest
     */
    public function withCodeRequest(CodeRequest|array $codeRequest): self
    {
        $obj = clone $this;
        $obj['code_request'] = $codeRequest;

        return $obj;
    }

    /**
     * @param Purchase|array{
     *   id: int,
     *   country_code: string,
     *   created_at: string,
     *   display_name: DisplayName,
     *   phone_number: string,
     *   price: Price,
     *   status: value-of<Purchase\Status>,
     *   verification: Verification|null,
     * } $purchase
     */
    public function withPurchase(Purchase|array $purchase): self
    {
        $obj = clone $this;
        $obj['purchase'] = $purchase;

        return $obj;
    }
}
