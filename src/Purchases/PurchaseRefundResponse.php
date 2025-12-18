<?php

declare(strict_types=1);

namespace Gmt\Purchases;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Purchases\PurchaseRefundResponse\Purchase;
use Gmt\Purchases\PurchaseRefundResponse\Refund;

/**
 * @phpstan-import-type PurchaseShape from \Gmt\Purchases\PurchaseRefundResponse\Purchase
 * @phpstan-import-type RefundShape from \Gmt\Purchases\PurchaseRefundResponse\Refund
 *
 * @phpstan-type PurchaseRefundResponseShape = array{
 *   purchase: Purchase|PurchaseShape, refund: Refund|RefundShape
 * }
 */
final class PurchaseRefundResponse implements BaseModel
{
    /** @use SdkModel<PurchaseRefundResponseShape> */
    use SdkModel;

    #[Required]
    public Purchase $purchase;

    #[Required]
    public Refund $refund;

    /**
     * `new PurchaseRefundResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchaseRefundResponse::with(purchase: ..., refund: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurchaseRefundResponse)->withPurchase(...)->withRefund(...)
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
     * @param Purchase|PurchaseShape $purchase
     * @param Refund|RefundShape $refund
     */
    public static function with(
        Purchase|array $purchase,
        Refund|array $refund
    ): self {
        $self = new self;

        $self['purchase'] = $purchase;
        $self['refund'] = $refund;

        return $self;
    }

    /**
     * @param Purchase|PurchaseShape $purchase
     */
    public function withPurchase(Purchase|array $purchase): self
    {
        $self = clone $this;
        $self['purchase'] = $purchase;

        return $self;
    }

    /**
     * @param Refund|RefundShape $refund
     */
    public function withRefund(Refund|array $refund): self
    {
        $self = clone $this;
        $self['refund'] = $refund;

        return $self;
    }
}
