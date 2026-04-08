<?php

declare(strict_types=1);

namespace Gmt\Telegram;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type TelegramGetStarsPriceResponseShape = array{
 *   amount: float, price: float
 * }
 */
final class TelegramGetStarsPriceResponse implements BaseModel
{
    /** @use SdkModel<TelegramGetStarsPriceResponseShape> */
    use SdkModel;

    /**
     * The amount of stars to purchase (50-10000).
     */
    #[Required]
    public float $amount;

    /**
     * The price of the stars.
     */
    #[Required]
    public float $price;

    /**
     * `new TelegramGetStarsPriceResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TelegramGetStarsPriceResponse::with(amount: ..., price: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TelegramGetStarsPriceResponse)->withAmount(...)->withPrice(...)
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
    public static function with(float $amount, float $price): self
    {
        $self = new self;

        $self['amount'] = $amount;
        $self['price'] = $price;

        return $self;
    }

    /**
     * The amount of stars to purchase (50-10000).
     */
    public function withAmount(float $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The price of the stars.
     */
    public function withPrice(float $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }
}
