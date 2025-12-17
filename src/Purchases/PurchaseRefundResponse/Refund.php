<?php

declare(strict_types=1);

namespace Gmt\Purchases\PurchaseRefundResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Purchases\PurchaseRefundResponse\Refund\Amount;

/**
 * @phpstan-import-type AmountShape from \Gmt\Purchases\PurchaseRefundResponse\Refund\Amount
 *
 * @phpstan-type RefundShape = array{
 *   amount: Amount|AmountShape, reason: string, refundedAt: string
 * }
 */
final class Refund implements BaseModel
{
    /** @use SdkModel<RefundShape> */
    use SdkModel;

    /**
     * Refunded amount (full purchase price).
     */
    #[Required]
    public Amount $amount;

    /**
     * Refund reason.
     */
    #[Required]
    public string $reason;

    /**
     * Refund timestamp in ISO 8601 format.
     */
    #[Required('refunded_at')]
    public string $refundedAt;

    /**
     * `new Refund()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Refund::with(amount: ..., reason: ..., refundedAt: ...)
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
     * @param AmountShape $amount
     */
    public static function with(
        Amount|array $amount,
        string $reason,
        string $refundedAt
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['reason'] = $reason;
        $self['refundedAt'] = $refundedAt;

        return $self;
    }

    /**
     * Refunded amount (full purchase price).
     *
     * @param AmountShape $amount
     */
    public function withAmount(Amount|array $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Refund reason.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * Refund timestamp in ISO 8601 format.
     */
    public function withRefundedAt(string $refundedAt): self
    {
        $self = clone $this;
        $self['refundedAt'] = $refundedAt;

        return $self;
    }
}
