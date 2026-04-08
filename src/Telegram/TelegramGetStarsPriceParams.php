<?php

declare(strict_types=1);

namespace Gmt\Telegram;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

/**
 * Returns the current price of stars in USD.
 *
 * @see Gmt\Services\TelegramService::getStarsPrice()
 *
 * @phpstan-type TelegramGetStarsPriceParamsShape = array{amount: string}
 */
final class TelegramGetStarsPriceParams implements BaseModel
{
    /** @use SdkModel<TelegramGetStarsPriceParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The amount of stars to purchase (50-10000).
     */
    #[Required]
    public string $amount;

    /**
     * `new TelegramGetStarsPriceParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TelegramGetStarsPriceParams::with(amount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TelegramGetStarsPriceParams)->withAmount(...)
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
    public static function with(string $amount): self
    {
        $self = new self;

        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The amount of stars to purchase (50-10000).
     */
    public function withAmount(string $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }
}
