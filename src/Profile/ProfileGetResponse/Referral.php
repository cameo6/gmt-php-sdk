<?php

declare(strict_types=1);

namespace Gmt\Profile\ProfileGetResponse;

use Gmt\Core\Attributes\Api;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Profile\ProfileGetResponse\Referral\Balance;
use Gmt\Profile\ProfileGetResponse\Referral\Level;
use Gmt\Profile\ProfileGetResponse\Referral\Profit;

/**
 * @phpstan-type ReferralShape = array{
 *   balance: \Gmt\Profile\ProfileGetResponse\Referral\Balance,
 *   level: value-of<Level>,
 *   percent: float,
 *   profit: Profit,
 *   referrals_count: int,
 * }
 */
final class Referral implements BaseModel
{
    /** @use SdkModel<ReferralShape> */
    use SdkModel;

    /**
     * Current referral balance available for withdrawal.
     */
    #[Api]
    public Balance $balance;

    /**
     * Current referral program level: bronze, silver, gold, platinum.
     *
     * @var value-of<Level> $level
     */
    #[Api(enum: Level::class)]
    public string $level;

    /**
     * Referral commission percentage.
     */
    #[Api]
    public float $percent;

    /**
     * Total lifetime earnings from referral commissions.
     */
    #[Api]
    public Profit $profit;

    /**
     * Total number of users invited through referral link.
     */
    #[Api]
    public int $referrals_count;

    /**
     * `new Referral()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Referral::with(
     *   balance: ..., level: ..., percent: ..., profit: ..., referrals_count: ...
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
     * @param Balance|array{
     *   amount: string, currency_code: string
     * } $balance
     * @param Level|value-of<Level> $level
     * @param Profit|array{amount: string, currency_code: string} $profit
     */
    public static function with(
        Balance|array $balance,
        Level|string $level,
        float $percent,
        Profit|array $profit,
        int $referrals_count,
    ): self {
        $obj = new self;

        $obj['balance'] = $balance;
        $obj['level'] = $level;
        $obj['percent'] = $percent;
        $obj['profit'] = $profit;
        $obj['referrals_count'] = $referrals_count;

        return $obj;
    }

    /**
     * Current referral balance available for withdrawal.
     *
     * @param Balance|array{
     *   amount: string, currency_code: string
     * } $balance
     */
    public function withBalance(
        Balance|array $balance
    ): self {
        $obj = clone $this;
        $obj['balance'] = $balance;

        return $obj;
    }

    /**
     * Current referral program level: bronze, silver, gold, platinum.
     *
     * @param Level|value-of<Level> $level
     */
    public function withLevel(Level|string $level): self
    {
        $obj = clone $this;
        $obj['level'] = $level;

        return $obj;
    }

    /**
     * Referral commission percentage.
     */
    public function withPercent(float $percent): self
    {
        $obj = clone $this;
        $obj['percent'] = $percent;

        return $obj;
    }

    /**
     * Total lifetime earnings from referral commissions.
     *
     * @param Profit|array{amount: string, currency_code: string} $profit
     */
    public function withProfit(Profit|array $profit): self
    {
        $obj = clone $this;
        $obj['profit'] = $profit;

        return $obj;
    }

    /**
     * Total number of users invited through referral link.
     */
    public function withReferralsCount(int $referralsCount): self
    {
        $obj = clone $this;
        $obj['referrals_count'] = $referralsCount;

        return $obj;
    }
}
