<?php

declare(strict_types=1);

namespace Gmt\Telegram\Purchases;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

/**
 * Creates a new purchase for Telegram stars. Deducts balance immediately and returns purchase details.
 *
 * @see Gmt\Services\Telegram\PurchasesService::createStars()
 *
 * @phpstan-type PurchaseCreateStarsParamsShape = array{
 *   amount: float, username: string
 * }
 */
final class PurchaseCreateStarsParams implements BaseModel
{
    /** @use SdkModel<PurchaseCreateStarsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The amount of stars to purchase (50-10000).
     */
    #[Required]
    public float $amount;

    /**
     * Recipient Telegram username (@optional, 5-32 chars).
     */
    #[Required]
    public string $username;

    /**
     * `new PurchaseCreateStarsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchaseCreateStarsParams::with(amount: ..., username: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurchaseCreateStarsParams)->withAmount(...)->withUsername(...)
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
    public static function with(float $amount, string $username): self
    {
        $self = new self;

        $self['amount'] = $amount;
        $self['username'] = $username;

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
     * Recipient Telegram username (@optional, 5-32 chars).
     */
    public function withUsername(string $username): self
    {
        $self = clone $this;
        $self['username'] = $username;

        return $self;
    }
}
