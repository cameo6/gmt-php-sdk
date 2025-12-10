<?php

declare(strict_types=1);

namespace Gmt\Profile;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
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
 *   createdAt: string,
 *   discount: Discount,
 *   referral: Referral,
 *   statistics: Statistics,
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
     * @param Balance|array{amount: string, currencyCode: string} $balance
     * @param Discount|array{level: value-of<Level>, percent: float} $discount
     * @param Referral|array{
     *   balance: Referral\Balance,
     *   level: value-of<Referral\Level>,
     *   percent: float,
     *   profit: Profit,
     *   referralsCount: int,
     * } $referral
     * @param Statistics|array{totalPurchases: int} $statistics
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
     * @param Balance|array{amount: string, currencyCode: string} $balance
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
     * @param Discount|array{level: value-of<Level>, percent: float} $discount
     */
    public function withDiscount(Discount|array $discount): self
    {
        $self = clone $this;
        $self['discount'] = $discount;

        return $self;
    }

    /**
     * @param Referral|array{
     *   balance: Referral\Balance,
     *   level: value-of<Referral\Level>,
     *   percent: float,
     *   profit: Profit,
     *   referralsCount: int,
     * } $referral
     */
    public function withReferral(Referral|array $referral): self
    {
        $self = clone $this;
        $self['referral'] = $referral;

        return $self;
    }

    /**
     * @param Statistics|array{totalPurchases: int} $statistics
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
