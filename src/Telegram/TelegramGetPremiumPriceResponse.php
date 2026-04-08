<?php

declare(strict_types=1);

namespace Gmt\Telegram;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type TelegramGetPremiumPriceResponseShape = array{
 *   mounts: float, price: float
 * }
 */
final class TelegramGetPremiumPriceResponse implements BaseModel
{
    /** @use SdkModel<TelegramGetPremiumPriceResponseShape> */
    use SdkModel;

    /**
     * The number of months for the premium subscription (3, 6, or 12).
     */
    #[Required]
    public float $mounts;

    /**
     * The price of the premium subscription.
     */
    #[Required]
    public float $price;

    /**
     * `new TelegramGetPremiumPriceResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TelegramGetPremiumPriceResponse::with(mounts: ..., price: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TelegramGetPremiumPriceResponse)->withMounts(...)->withPrice(...)
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
    public static function with(float $mounts, float $price): self
    {
        $self = new self;

        $self['mounts'] = $mounts;
        $self['price'] = $price;

        return $self;
    }

    /**
     * The number of months for the premium subscription (3, 6, or 12).
     */
    public function withMounts(float $mounts): self
    {
        $self = clone $this;
        $self['mounts'] = $mounts;

        return $self;
    }

    /**
     * The price of the premium subscription.
     */
    public function withPrice(float $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }
}
