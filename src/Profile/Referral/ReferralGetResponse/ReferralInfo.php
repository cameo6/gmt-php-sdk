<?php

declare(strict_types=1);

namespace Gmt\Profile\Referral\ReferralGetResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Profile\Referral\ReferralGetResponse\ReferralInfo\Balance;
use Gmt\Profile\Referral\ReferralGetResponse\ReferralInfo\Profit;

/**
 * @phpstan-import-type BalanceShape from \Gmt\Profile\Referral\ReferralGetResponse\ReferralInfo\Balance
 * @phpstan-import-type ProfitShape from \Gmt\Profile\Referral\ReferralGetResponse\ReferralInfo\Profit
 *
 * @phpstan-type ReferralInfoShape = array{
 *   balance: Balance|BalanceShape, profit: Profit|ProfitShape, referralsCount: int
 * }
 */
final class ReferralInfo implements BaseModel
{
    /** @use SdkModel<ReferralInfoShape> */
    use SdkModel;

    /**
     * Current referral balance.
     */
    #[Required]
    public Balance $balance;

    /**
     * Total lifetime referral earnings.
     */
    #[Required]
    public Profit $profit;

    /**
     * Total number of referrals.
     */
    #[Required('referrals_count')]
    public int $referralsCount;

    /**
     * `new ReferralInfo()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReferralInfo::with(balance: ..., profit: ..., referralsCount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReferralInfo)->withBalance(...)->withProfit(...)->withReferralsCount(...)
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
     *
     * @param Balance|BalanceShape $balance
     * @param Profit|ProfitShape $profit
     */
    public static function with(
        Balance|array $balance,
        Profit|array $profit,
        int $referralsCount
    ): self {
        $self = new self;

        $self['balance'] = $balance;
        $self['profit'] = $profit;
        $self['referralsCount'] = $referralsCount;

        return $self;
    }

    /**
     * Current referral balance.
     *
     * @param Balance|BalanceShape $balance
     */
    public function withBalance(Balance|array $balance): self
    {
        $self = clone $this;
        $self['balance'] = $balance;

        return $self;
    }

    /**
     * Total lifetime referral earnings.
     *
     * @param Profit|ProfitShape $profit
     */
    public function withProfit(Profit|array $profit): self
    {
        $self = clone $this;
        $self['profit'] = $profit;

        return $self;
    }

    /**
     * Total number of referrals.
     */
    public function withReferralsCount(int $referralsCount): self
    {
        $self = clone $this;
        $self['referralsCount'] = $referralsCount;

        return $self;
    }
}
