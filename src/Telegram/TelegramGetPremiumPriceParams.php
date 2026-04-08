<?php

declare(strict_types=1);

namespace Gmt\Telegram;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

/**
 * Returns the current price of Telegram premium subscription in USD.
 *
 * @see Gmt\Services\TelegramService::getPremiumPrice()
 *
 * @phpstan-type TelegramGetPremiumPriceParamsShape = array{mounts: string}
 */
final class TelegramGetPremiumPriceParams implements BaseModel
{
    /** @use SdkModel<TelegramGetPremiumPriceParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The number of months for the premium subscription (3, 6, or 12).
     */
    #[Required]
    public string $mounts;

    /**
     * `new TelegramGetPremiumPriceParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TelegramGetPremiumPriceParams::with(mounts: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TelegramGetPremiumPriceParams)->withMounts(...)
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
    public static function with(string $mounts): self
    {
        $self = new self;

        $self['mounts'] = $mounts;

        return $self;
    }

    /**
     * The number of months for the premium subscription (3, 6, or 12).
     */
    public function withMounts(string $mounts): self
    {
        $self = clone $this;
        $self['mounts'] = $mounts;

        return $self;
    }
}
