<?php

declare(strict_types=1);

namespace Gmt\Telegram\Purchases;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

/**
 * Creates a new purchase for Telegram premium subscription. Deducts balance immediately and returns purchase details.
 *
 * @see Gmt\Services\Telegram\PurchasesService::createPremium()
 *
 * @phpstan-type PurchaseCreatePremiumParamsShape = array{
 *   mounts: float, username: string
 * }
 */
final class PurchaseCreatePremiumParams implements BaseModel
{
    /** @use SdkModel<PurchaseCreatePremiumParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The number of months for the premium subscription (3, 6, or 12).
     */
    #[Required]
    public float $mounts;

    /**
     * Recipient Telegram username (@optional, 5-32 chars).
     */
    #[Required]
    public string $username;

    /**
     * `new PurchaseCreatePremiumParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchaseCreatePremiumParams::with(mounts: ..., username: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurchaseCreatePremiumParams)->withMounts(...)->withUsername(...)
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
    public static function with(float $mounts, string $username): self
    {
        $self = new self;

        $self['mounts'] = $mounts;
        $self['username'] = $username;

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
     * Recipient Telegram username (@optional, 5-32 chars).
     */
    public function withUsername(string $username): self
    {
        $self = clone $this;
        $self['username'] = $username;

        return $self;
    }
}
