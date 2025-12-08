<?php

declare(strict_types=1);

namespace Gmt\Purchases;

use Gmt\Core\Attributes\Api;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkResponse;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Core\Conversion\Contracts\ResponseConverter;
use Gmt\Purchases\PurchaseRefundResponse\Purchase;
use Gmt\Purchases\PurchaseRefundResponse\Purchase\DisplayName;
use Gmt\Purchases\PurchaseRefundResponse\Purchase\Price;
use Gmt\Purchases\PurchaseRefundResponse\Purchase\Status;
use Gmt\Purchases\PurchaseRefundResponse\Purchase\Verification;
use Gmt\Purchases\PurchaseRefundResponse\Refund;
use Gmt\Purchases\PurchaseRefundResponse\Refund\Amount;

/**
 * @phpstan-type PurchaseRefundResponseShape = array{
 *   purchase: Purchase, refund: Refund
 * }
 */
final class PurchaseRefundResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<PurchaseRefundResponseShape> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public Purchase $purchase;

    #[Api]
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
     * @param Purchase|array{
     *   id: int,
     *   country_code: string,
     *   created_at: string,
     *   display_name: DisplayName,
     *   phone_number: string,
     *   price: Price,
     *   status: value-of<Status>,
     *   verification: Verification|null,
     * } $purchase
     * @param Refund|array{amount: Amount, reason: string, refunded_at: string} $refund
     */
    public static function with(
        Purchase|array $purchase,
        Refund|array $refund
    ): self {
        $obj = new self;

        $obj['purchase'] = $purchase;
        $obj['refund'] = $refund;

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
     *   status: value-of<Status>,
     *   verification: Verification|null,
     * } $purchase
     */
    public function withPurchase(Purchase|array $purchase): self
    {
        $obj = clone $this;
        $obj['purchase'] = $purchase;

        return $obj;
    }

    /**
     * @param Refund|array{amount: Amount, reason: string, refunded_at: string} $refund
     */
    public function withRefund(Refund|array $refund): self
    {
        $obj = clone $this;
        $obj['refund'] = $refund;

        return $obj;
    }
}
