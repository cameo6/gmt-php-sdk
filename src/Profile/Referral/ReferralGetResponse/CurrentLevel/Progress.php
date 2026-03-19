<?php

declare(strict_types=1);

namespace Gmt\Profile\Referral\ReferralGetResponse\CurrentLevel;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProgressShape = array{deposits: float, referrals: int}
 */
final class Progress implements BaseModel
{
    /** @use SdkModel<ProgressShape> */
    use SdkModel;

    /**
     * Total deposits from referrals (in USD).
     */
    #[Required]
    public float $deposits;

    /**
     * Number of active referrals.
     */
    #[Required]
    public int $referrals;

    /**
     * `new Progress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Progress::with(deposits: ..., referrals: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Progress)->withDeposits(...)->withReferrals(...)
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
    public static function with(float $deposits, int $referrals): self
    {
        $self = new self;

        $self['deposits'] = $deposits;
        $self['referrals'] = $referrals;

        return $self;
    }

    /**
     * Total deposits from referrals (in USD).
     */
    public function withDeposits(float $deposits): self
    {
        $self = clone $this;
        $self['deposits'] = $deposits;

        return $self;
    }

    /**
     * Number of active referrals.
     */
    public function withReferrals(int $referrals): self
    {
        $self = clone $this;
        $self['referrals'] = $referrals;

        return $self;
    }
}
