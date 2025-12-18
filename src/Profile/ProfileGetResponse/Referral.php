<?php

declare(strict_types=1);

namespace Gmt\Profile\ProfileGetResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Profile\ProfileGetResponse\Referral\Balance;
use Gmt\Profile\ProfileGetResponse\Referral\Level;
use Gmt\Profile\ProfileGetResponse\Referral\Profit;

/**
 * @phpstan-import-type BalanceShape from \Gmt\Profile\ProfileGetResponse\Referral\Balance
 * @phpstan-import-type ProfitShape from \Gmt\Profile\ProfileGetResponse\Referral\Profit
 *
 * @phpstan-type ReferralShape = array{
 *   balance: \Gmt\Profile\ProfileGetResponse\Referral\Balance|BalanceShape,
 *   level: Level|value-of<Level>,
 *   percent: float,
 *   profit: Profit|ProfitShape,
 *   referralsCount: int,
 * }
 */
final class Referral implements BaseModel
{
    /** @use SdkModel<ReferralShape> */
    use SdkModel;

    /**
     * Current referral balance available for withdrawal.
     */
    #[Required]
    public Balance $balance;

    /**
     * Current referral program level: bronze, silver, gold, platinum.
     *
     * @var value-of<Level> $level
     */
    #[Required(enum: Level::class)]
    public string $level;

    /**
     * Referral commission percentage.
     */
    #[Required]
    public float $percent;

    /**
     * Total lifetime earnings from referral commissions.
     */
    #[Required]
    public Profit $profit;

    /**
     * Total number of users invited through referral link.
     */
    #[Required('referrals_count')]
    public int $referralsCount;

    /**
     * `new Referral()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Referral::with(
     *   balance: ..., level: ..., percent: ..., profit: ..., referralsCount: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Referral)
     *   ->withBalance(...)
     *   ->withLevel(...)
     *   ->withPercent(...)
     *   ->withProfit(...)
     *   ->withReferralsCount(...)
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
     * @param Level|value-of<Level> $level
     * @param Profit|ProfitShape $profit
     */
    public static function with(
        Balance|array $balance,
        Level|string $level,
        float $percent,
        Profit|array $profit,
        int $referralsCount,
    ): self {
        $self = new self;

        $self['balance'] = $balance;
        $self['level'] = $level;
        $self['percent'] = $percent;
        $self['profit'] = $profit;
        $self['referralsCount'] = $referralsCount;

        return $self;
    }

    /**
     * Current referral balance available for withdrawal.
     *
     * @param Balance|BalanceShape $balance
     */
    public function withBalance(
        Balance|array $balance
    ): self {
        $self = clone $this;
        $self['balance'] = $balance;

        return $self;
    }

    /**
     * Current referral program level: bronze, silver, gold, platinum.
     *
     * @param Level|value-of<Level> $level
     */
    public function withLevel(Level|string $level): self
    {
        $self = clone $this;
        $self['level'] = $level;

        return $self;
    }

    /**
     * Referral commission percentage.
     */
    public function withPercent(float $percent): self
    {
        $self = clone $this;
        $self['percent'] = $percent;

        return $self;
    }

    /**
     * Total lifetime earnings from referral commissions.
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
     * Total number of users invited through referral link.
     */
    public function withReferralsCount(int $referralsCount): self
    {
        $self = clone $this;
        $self['referralsCount'] = $referralsCount;

        return $self;
    }
}
