<?php

declare(strict_types=1);

namespace Gmt\Profile;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Profile\ProfileGetResponse\Balance;
use Gmt\Profile\ProfileGetResponse\Discount;
use Gmt\Profile\ProfileGetResponse\Referral;
use Gmt\Profile\ProfileGetResponse\Statistics;

/**
 * Successful response.
 *
 * @phpstan-import-type BalanceShape from \Gmt\Profile\ProfileGetResponse\Balance
 * @phpstan-import-type DiscountShape from \Gmt\Profile\ProfileGetResponse\Discount
 * @phpstan-import-type ReferralShape from \Gmt\Profile\ProfileGetResponse\Referral
 * @phpstan-import-type StatisticsShape from \Gmt\Profile\ProfileGetResponse\Statistics
 *
 * @phpstan-type ProfileGetResponseShape = array{
 *   balance: Balance|BalanceShape,
 *   createdAt: string,
 *   discount: Discount|DiscountShape,
 *   referral: Referral|ReferralShape,
 *   statistics: Statistics|StatisticsShape,
 *   telegramID: string,
 *   telegramUsername: string|null,
 * }
 */
final class ProfileGetResponse implements BaseModel
{
    /** @use SdkModel<ProfileGetResponseShape> */
    use SdkModel;

    #[Required]
    public Balance $balance;

    /**
     * Account creation time in ISO 8601 format (UTC).
     */
    #[Required('created_at')]
    public string $createdAt;

    #[Required]
    public Discount $discount;

    #[Required]
    public Referral $referral;

    #[Required]
    public Statistics $statistics;

    /**
     * User's Telegram ID.
     */
    #[Required('telegram_id')]
    public string $telegramID;

    /**
     * User's Telegram username.
     */
    #[Required('telegram_username')]
    public ?string $telegramUsername;

    /**
     * `new ProfileGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProfileGetResponse::with(
     *   balance: ...,
     *   createdAt: ...,
     *   discount: ...,
     *   referral: ...,
     *   statistics: ...,
     *   telegramID: ...,
     *   telegramUsername: ...,
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
     * @param Balance|BalanceShape $balance
     * @param Discount|DiscountShape $discount
     * @param Referral|ReferralShape $referral
     * @param Statistics|StatisticsShape $statistics
     */
    public static function with(
        Balance|array $balance,
        string $createdAt,
        Discount|array $discount,
        Referral|array $referral,
        Statistics|array $statistics,
        string $telegramID,
        ?string $telegramUsername,
    ): self {
        $self = new self;

        $self['balance'] = $balance;
        $self['createdAt'] = $createdAt;
        $self['discount'] = $discount;
        $self['referral'] = $referral;
        $self['statistics'] = $statistics;
        $self['telegramID'] = $telegramID;
        $self['telegramUsername'] = $telegramUsername;

        return $self;
    }

    /**
     * @param Balance|BalanceShape $balance
     */
    public function withBalance(Balance|array $balance): self
    {
        $self = clone $this;
        $self['balance'] = $balance;

        return $self;
    }

    /**
     * Account creation time in ISO 8601 format (UTC).
     */
    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * @param Discount|DiscountShape $discount
     */
    public function withDiscount(Discount|array $discount): self
    {
        $self = clone $this;
        $self['discount'] = $discount;

        return $self;
    }

    /**
     * @param Referral|ReferralShape $referral
     */
    public function withReferral(Referral|array $referral): self
    {
        $self = clone $this;
        $self['referral'] = $referral;

        return $self;
    }

    /**
     * @param Statistics|StatisticsShape $statistics
     */
    public function withStatistics(Statistics|array $statistics): self
    {
        $self = clone $this;
        $self['statistics'] = $statistics;

        return $self;
    }

    /**
     * User's Telegram ID.
     */
    public function withTelegramID(string $telegramID): self
    {
        $self = clone $this;
        $self['telegramID'] = $telegramID;

        return $self;
    }

    /**
     * User's Telegram username.
     */
    public function withTelegramUsername(?string $telegramUsername): self
    {
        $self = clone $this;
        $self['telegramUsername'] = $telegramUsername;

        return $self;
    }
}
