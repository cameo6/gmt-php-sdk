<?php

declare(strict_types=1);

namespace Gmt\Profile\Referral;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

/**
 * Transfers a specified amount from the user's referral balance to their main balance. The amount must be between 1 and 100,000 USD.
 *
 * @see Gmt\Services\Profile\ReferralService::transferBalance()
 *
 * @phpstan-type ReferralTransferBalanceParamsShape = array{amount: float}
 */
final class ReferralTransferBalanceParams implements BaseModel
{
    /** @use SdkModel<ReferralTransferBalanceParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Amount to transfer from referral balance.
     */
    #[Required]
    public float $amount;

    /**
     * `new ReferralTransferBalanceParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReferralTransferBalanceParams::with(amount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReferralTransferBalanceParams)->withAmount(...)
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
    public static function with(float $amount): self
    {
        $self = new self;

        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Amount to transfer from referral balance.
     */
    public function withAmount(float $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }
}
