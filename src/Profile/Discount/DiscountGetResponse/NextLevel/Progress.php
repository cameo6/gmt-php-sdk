<?php

declare(strict_types=1);

namespace Gmt\Profile\Discount\DiscountGetResponse\NextLevel;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProgressShape = array{purchases: int, purchasesRemaining: int}
 */
final class Progress implements BaseModel
{
    /** @use SdkModel<ProgressShape> */
    use SdkModel;

    /**
     * Current number of purchases.
     */
    #[Required]
    public int $purchases;

    /**
     * Remaining purchases to reach the next level.
     */
    #[Required('purchases_remaining')]
    public int $purchasesRemaining;

    /**
     * `new Progress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Progress::with(purchases: ..., purchasesRemaining: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Progress)->withPurchases(...)->withPurchasesRemaining(...)
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
    public static function with(int $purchases, int $purchasesRemaining): self
    {
        $self = new self;

        $self['purchases'] = $purchases;
        $self['purchasesRemaining'] = $purchasesRemaining;

        return $self;
    }

    /**
     * Current number of purchases.
     */
    public function withPurchases(int $purchases): self
    {
        $self = clone $this;
        $self['purchases'] = $purchases;

        return $self;
    }

    /**
     * Remaining purchases to reach the next level.
     */
    public function withPurchasesRemaining(int $purchasesRemaining): self
    {
        $self = clone $this;
        $self['purchasesRemaining'] = $purchasesRemaining;

        return $self;
    }
}
