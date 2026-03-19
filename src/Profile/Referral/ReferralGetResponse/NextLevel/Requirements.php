<?php

declare(strict_types=1);

namespace Gmt\Profile\Referral\ReferralGetResponse\NextLevel;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type RequirementsShape = array{
 *   deposits: float,
 *   referrals: int,
 *   remainingDeposits: float,
 *   remainingReferrals: int,
 * }
 */
final class Requirements implements BaseModel
{
    /** @use SdkModel<RequirementsShape> */
    use SdkModel;

    /**
     * Required total deposits from referrals.
     */
    #[Required]
    public float $deposits;

    /**
     * Required number of referrals.
     */
    #[Required]
    public int $referrals;

    /**
     * Remaining deposits to reach the next level.
     */
    #[Required('remaining_deposits')]
    public float $remainingDeposits;

    /**
     * Remaining referrals to reach the next level.
     */
    #[Required('remaining_referrals')]
    public int $remainingReferrals;

    /**
     * `new Requirements()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Requirements::with(
     *   deposits: ..., referrals: ..., remainingDeposits: ..., remainingReferrals: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Requirements)
     *   ->withDeposits(...)
     *   ->withReferrals(...)
     *   ->withRemainingDeposits(...)
     *   ->withRemainingReferrals(...)
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
    public static function with(
        float $deposits,
        int $referrals,
        float $remainingDeposits,
        int $remainingReferrals,
    ): self {
        $self = new self;

        $self['deposits'] = $deposits;
        $self['referrals'] = $referrals;
        $self['remainingDeposits'] = $remainingDeposits;
        $self['remainingReferrals'] = $remainingReferrals;

        return $self;
    }

    /**
     * Required total deposits from referrals.
     */
    public function withDeposits(float $deposits): self
    {
        $self = clone $this;
        $self['deposits'] = $deposits;

        return $self;
    }

    /**
     * Required number of referrals.
     */
    public function withReferrals(int $referrals): self
    {
        $self = clone $this;
        $self['referrals'] = $referrals;

        return $self;
    }

    /**
     * Remaining deposits to reach the next level.
     */
    public function withRemainingDeposits(float $remainingDeposits): self
    {
        $self = clone $this;
        $self['remainingDeposits'] = $remainingDeposits;

        return $self;
    }

    /**
     * Remaining referrals to reach the next level.
     */
    public function withRemainingReferrals(int $remainingReferrals): self
    {
        $self = clone $this;
        $self['remainingReferrals'] = $remainingReferrals;

        return $self;
    }
}
