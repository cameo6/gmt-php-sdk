<?php

declare(strict_types=1);

namespace Gmt\Accounts\AccountGetResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type DiscountShape = array{basePrice: string, percent: float}
 */
final class Discount implements BaseModel
{
    /** @use SdkModel<DiscountShape> */
    use SdkModel;

    /**
     * Original price without discount.
     */
    #[Required('base_price')]
    public string $basePrice;

    /**
     * Discount percentage applied to this user.
     */
    #[Required]
    public float $percent;

    /**
     * `new Discount()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Discount::with(basePrice: ..., percent: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Discount)->withBasePrice(...)->withPercent(...)
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
    public static function with(string $basePrice, float $percent): self
    {
        $self = new self;

        $self['basePrice'] = $basePrice;
        $self['percent'] = $percent;

        return $self;
    }

    /**
     * Original price without discount.
     */
    public function withBasePrice(string $basePrice): self
    {
        $self = clone $this;
        $self['basePrice'] = $basePrice;

        return $self;
    }

    /**
     * Discount percentage applied to this user.
     */
    public function withPercent(float $percent): self
    {
        $self = clone $this;
        $self['percent'] = $percent;

        return $self;
    }
}
