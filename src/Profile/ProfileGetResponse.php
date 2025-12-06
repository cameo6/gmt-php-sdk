<?php

declare(strict_types=1);

namespace Gmt\Profile;

use Gmt\Core\Attributes\Api;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkResponse;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Core\Conversion\Contracts\ResponseConverter;
use Gmt\Profile\ProfileGetResponse\Balance;
use Gmt\Profile\ProfileGetResponse\Discount;
use Gmt\Profile\ProfileGetResponse\Discount\Level;
use Gmt\Profile\ProfileGetResponse\Referral;
use Gmt\Profile\ProfileGetResponse\Referral\Profit;
use Gmt\Profile\ProfileGetResponse\Statistics;

/**
 * Successful response.
 *
 * @phpstan-type ProfileGetResponseShape = array{
 *   balance: Balance,
 *   created_at: string,
 *   discount: Discount,
 *   referral: Referral,
 *   statistics: Statistics,
 *   telegram_id: string,
 *   telegram_username: string|null,
 * }
 */
final class ProfileGetResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<ProfileGetResponseShape> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public Balance $balance;

    /**
     * Account creation time in ISO 8601 format (UTC).
     */
    #[Api]
    public string $created_at;

    #[Api]
    public Discount $discount;

    #[Api]
    public Referral $referral;

    #[Api]
    public Statistics $statistics;

    /**
     * User's Telegram ID.
     */
    #[Api]
    public string $telegram_id;

    /**
     * User's Telegram username.
     */
    #[Api]
    public ?string $telegram_username;

    /**
     * `new ProfileGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProfileGetResponse::with(
     *   balance: ...,
     *   created_at: ...,
     *   discount: ...,
     *   referral: ...,
     *   statistics: ...,
     *   telegram_id: ...,
     *   telegram_username: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProfileGetResponse)
     *   ->withBalance(...)
     *   ->withCreatedAt(...)
     *   ->withDiscount(...)
     *   ->withReferral(...)
     *   ->withStatistics(...)
     *   ->withTelegramID(...)
     *   ->withTelegramUsername(...)
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
     * @param Balance|array{amount: string, currency_code: string} $balance
     * @param Discount|array{level: value-of<Level>, percent: float} $discount
     * @param Referral|array{
     *   balance: Referral\Balance,
     *   level: value-of<Referral\Level>,
     *   percent: float,
     *   profit: Profit,
     *   referrals_count: int,
     * } $referral
     * @param Statistics|array{total_purchases: int} $statistics
     */
    public static function with(
        Balance|array $balance,
        string $created_at,
        Discount|array $discount,
        Referral|array $referral,
        Statistics|array $statistics,
        string $telegram_id,
        ?string $telegram_username,
    ): self {
        $obj = new self;

        $obj['balance'] = $balance;
        $obj['created_at'] = $created_at;
        $obj['discount'] = $discount;
        $obj['referral'] = $referral;
        $obj['statistics'] = $statistics;
        $obj['telegram_id'] = $telegram_id;
        $obj['telegram_username'] = $telegram_username;

        return $obj;
    }

    /**
     * @param Balance|array{amount: string, currency_code: string} $balance
     */
    public function withBalance(Balance|array $balance): self
    {
        $obj = clone $this;
        $obj['balance'] = $balance;

        return $obj;
    }

    /**
     * Account creation time in ISO 8601 format (UTC).
     */
    public function withCreatedAt(string $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * @param Discount|array{level: value-of<Level>, percent: float} $discount
     */
    public function withDiscount(Discount|array $discount): self
    {
        $obj = clone $this;
        $obj['discount'] = $discount;

        return $obj;
    }

    /**
     * @param Referral|array{
     *   balance: Referral\Balance,
     *   level: value-of<Referral\Level>,
     *   percent: float,
     *   profit: Profit,
     *   referrals_count: int,
     * } $referral
     */
    public function withReferral(Referral|array $referral): self
    {
        $obj = clone $this;
        $obj['referral'] = $referral;

        return $obj;
    }

    /**
     * @param Statistics|array{total_purchases: int} $statistics
     */
    public function withStatistics(Statistics|array $statistics): self
    {
        $obj = clone $this;
        $obj['statistics'] = $statistics;

        return $obj;
    }

    /**
     * User's Telegram ID.
     */
    public function withTelegramID(string $telegramID): self
    {
        $obj = clone $this;
        $obj['telegram_id'] = $telegramID;

        return $obj;
    }

    /**
     * User's Telegram username.
     */
    public function withTelegramUsername(?string $telegramUsername): self
    {
        $obj = clone $this;
        $obj['telegram_username'] = $telegramUsername;

        return $obj;
    }
}
