<?php

declare(strict_types=1);

namespace Gmt\Purchases\PurchaseRefundResponse;

use Gmt\Core\Attributes\Api;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Purchases\PurchaseRefundResponse\Refund\Amount;

/**
 * @phpstan-type RefundShape = array{
 *   amount: Amount, reason: string, refunded_at: string
 * }
 */
final class Refund implements BaseModel
{
    /** @use SdkModel<RefundShape> */
    use SdkModel;

    /**
     * Refunded amount (full purchase price).
     */
    #[Api]
    public Amount $amount;

    /**
     * Refund reason.
     */
    #[Api]
    public string $reason;

    /**
     * Refund timestamp in ISO 8601 format.
     */
    #[Api]
    public string $refunded_at;

    /**
     * `new Refund()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Refund::with(amount: ..., reason: ..., refunded_at: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Refund)->withAmount(...)->withReason(...)->withRefundedAt(...)
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
     * @param Amount|array{amount: string, currency_code: string} $amount
     */
    public static function with(
        Amount|array $amount,
        string $reason,
        string $refunded_at
    ): self {
        $obj = new self;

        $obj['amount'] = $amount;
        $obj['reason'] = $reason;
        $obj['refunded_at'] = $refunded_at;

        return $obj;
    }

    /**
     * Refunded amount (full purchase price).
     *
     * @param Amount|array{amount: string, currency_code: string} $amount
     */
    public function withAmount(Amount|array $amount): self
    {
        $obj = clone $this;
        $obj['amount'] = $amount;

        return $obj;
    }

    /**
     * Refund reason.
     */
    public function withReason(string $reason): self
    {
        $obj = clone $this;
        $obj['reason'] = $reason;

        return $obj;
    }

    /**
     * Refund timestamp in ISO 8601 format.
     */
    public function withRefundedAt(string $refundedAt): self
    {
        $obj = clone $this;
        $obj['refunded_at'] = $refundedAt;

        return $obj;
    }
}
