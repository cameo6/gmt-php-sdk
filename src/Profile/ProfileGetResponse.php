<?php

declare(strict_types=1);

namespace Gmt\Profile;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Profile\ProfileGetResponse\Balance;
use Gmt\Profile\ProfileGetResponse\Discount;
use Gmt\Profile\ProfileGetResponse\Statistics;

/**
 * @phpstan-import-type BalanceShape from \Gmt\Profile\ProfileGetResponse\Balance
 * @phpstan-import-type DiscountShape from \Gmt\Profile\ProfileGetResponse\Discount
 * @phpstan-import-type StatisticsShape from \Gmt\Profile\ProfileGetResponse\Statistics
 *
 * @phpstan-type ProfileGetResponseShape = array{
 *   id: string,
 *   balance: Balance|BalanceShape,
 *   createdAt: string,
 *   discount: Discount|DiscountShape,
 *   login: string|null,
 *   statistics: Statistics|StatisticsShape,
 *   telegramID: string|null,
 *   telegramUsername: string|null,
 * }
 */
final class ProfileGetResponse implements BaseModel
{
    /** @use SdkModel<ProfileGetResponseShape> */
    use SdkModel;

    /**
     * User Database ID.
     */
    #[Required]
    public string $id;

    #[Required]
    public Balance $balance;

    /**
     * Account creation time in ISO 8601 format (UTC).
     */
    #[Required('created_at')]
    public string $createdAt;

    #[Required]
    public Discount $discount;

    /**
     * Web username.
     */
    #[Required]
    public ?string $login;

    #[Required]
    public Statistics $statistics;

    /**
     * User's Telegram ID (null for web-only users).
     */
    #[Required('telegram_id')]
    public ?string $telegramID;

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
     *   id: ...,
     *   balance: ...,
     *   createdAt: ...,
     *   discount: ...,
     *   login: ...,
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
     *   ->withID(...)
     *   ->withBalance(...)
     *   ->withCreatedAt(...)
     *   ->withDiscount(...)
     *   ->withLogin(...)
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
     * @param Statistics|StatisticsShape $statistics
     */
    public static function with(
        string $id,
        Balance|array $balance,
        string $createdAt,
        Discount|array $discount,
        ?string $login,
        Statistics|array $statistics,
        ?string $telegramID,
        ?string $telegramUsername,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['balance'] = $balance;
        $self['createdAt'] = $createdAt;
        $self['discount'] = $discount;
        $self['login'] = $login;
        $self['statistics'] = $statistics;
        $self['telegramID'] = $telegramID;
        $self['telegramUsername'] = $telegramUsername;

        return $self;
    }

    /**
     * User Database ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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
     * Web username.
     */
    public function withLogin(?string $login): self
    {
        $self = clone $this;
        $self['login'] = $login;

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
     * User's Telegram ID (null for web-only users).
     */
    public function withTelegramID(?string $telegramID): self
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
