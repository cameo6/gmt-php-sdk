<?php

declare(strict_types=1);

namespace Gmt\Accounts\AccountGetResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type DiscountShape = array{base_price: string, percent: float}
 */
final class Discount implements BaseModel
{
    /** @use SdkModel<DiscountShape> */
    use SdkModel;

    /**
     * Original price without discount.
     */
    #[Required]
    public string $base_price;

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
     * Discount::with(base_price: ..., percent: ...)
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
    public static function with(string $base_price, float $percent): self
    {
        $obj = new self;

        $obj['base_price'] = $base_price;
        $obj['percent'] = $percent;

        return $obj;
    }

    /**
     * Original price without discount.
     */
    public function withBasePrice(string $basePrice): self
    {
        $obj = clone $this;
        $obj['base_price'] = $basePrice;

        return $obj;
    }

    /**
     * Discount percentage applied to this user.
     */
    public function withPercent(float $percent): self
    {
        $obj = clone $this;
        $obj['percent'] = $percent;

        return $obj;
    }
}
