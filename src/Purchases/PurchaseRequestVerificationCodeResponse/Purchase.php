<?php

declare(strict_types=1);

namespace Gmt\Purchases\PurchaseRequestVerificationCodeResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\Purchase\DisplayName;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\Purchase\Price;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\Purchase\Status;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\Purchase\Verification;

/**
 * @phpstan-import-type DisplayNameShape from \Gmt\Purchases\PurchaseRequestVerificationCodeResponse\Purchase\DisplayName
 * @phpstan-import-type PriceShape from \Gmt\Purchases\PurchaseRequestVerificationCodeResponse\Purchase\Price
 * @phpstan-import-type VerificationShape from \Gmt\Purchases\PurchaseRequestVerificationCodeResponse\Purchase\Verification
 *
 * @phpstan-type PurchaseShape = array{
 *   id: int,
 *   countryCode: string,
 *   createdAt: string,
 *   displayName: DisplayName|DisplayNameShape,
 *   phoneNumber: string,
 *   price: Price|PriceShape,
 *   status: Status|value-of<Status>,
 *   verification: null|Verification|VerificationShape,
 * }
 */
final class Purchase implements BaseModel
{
    /** @use SdkModel<PurchaseShape> */
    use SdkModel;

    /**
     * Unique purchase identifier.
     */
    #[Required]
    public int $id;

    /**
     * ISO 3166-1 alpha-2 country code.
     */
    #[Required('country_code')]
    public string $countryCode;

    /**
     * Purchase creation time in ISO 8601 format (UTC).
     */
    #[Required('created_at')]
    public string $createdAt;

    #[Required('display_name')]
    public DisplayName $displayName;

    /**
     * **E.164 International Format.** Phone number with country code prefix (e.g., `+12025550123` for US, `+79991234567` for Russia).
     *
     * **Usage.** This is your Telegram account login. Use it with `verification.code` and `verification.password` to access the account.
     */
    #[Required('phone_number')]
    public string $phoneNumber;

    /**
     * **Final Price After Discount.** The actual amount deducted from your balance, with your personal discount already applied.
     *
     * **To see pricing breakdown before purchase.** Check `GET /accounts/:country_code` which shows both discounted price and original `base_price`.
     *
     * **Discount eligibility.** Based on your total successful purchase count. Higher volume = bigger discounts.
     */
    #[Required]
    public Price $price;

    /**
     * **Purchase Status Lifecycle.** `PENDING` (initial) → `SUCCESS` (after code request) or `ERROR` (provider failure). Any status can transition to `REFUND` via admin action.
     *
     * **Important.** Status is immutable once set to `SUCCESS`, `ERROR`, or `REFUND`.
     *
     * **Filter options**
     * - `PENDING` - code not requested.
     * - `SUCCESS` - code ready.
     * - `ERROR` - provider failed.
     * - `REFUND` - money returned.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * **Verification Credentials.** Login credentials for the purchased Telegram account. Initially `null` after purchase creation.
     *
     * **Availability.** Populated after calling `POST /purchases/:id/request-code`. Once received, credentials are permanent and cannot be re-requested.
     *
     * **Security.** Verification data is only visible to the purchase owner.
     */
    #[Required]
    public ?Verification $verification;

    /**
     * `new Purchase()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Purchase::with(
     *   id: ...,
     *   countryCode: ...,
     *   createdAt: ...,
     *   displayName: ...,
     *   phoneNumber: ...,
     *   price: ...,
     *   status: ...,
     *   verification: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Purchase)
     *   ->withID(...)
     *   ->withCountryCode(...)
     *   ->withCreatedAt(...)
     *   ->withDisplayName(...)
     *   ->withPhoneNumber(...)
     *   ->withPrice(...)
     *   ->withStatus(...)
     *   ->withVerification(...)
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
     * @param DisplayName|DisplayNameShape $displayName
     * @param Price|PriceShape $price
     * @param Status|value-of<Status> $status
     * @param Verification|VerificationShape|null $verification
     */
    public static function with(
        int $id,
        string $countryCode,
        string $createdAt,
        DisplayName|array $displayName,
        string $phoneNumber,
        Price|array $price,
        Status|string $status,
        Verification|array|null $verification,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['countryCode'] = $countryCode;
        $self['createdAt'] = $createdAt;
        $self['displayName'] = $displayName;
        $self['phoneNumber'] = $phoneNumber;
        $self['price'] = $price;
        $self['status'] = $status;
        $self['verification'] = $verification;

        return $self;
    }

    /**
     * Unique purchase identifier.
     */
    public function withID(int $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * ISO 3166-1 alpha-2 country code.
     */
    public function withCountryCode(string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * Purchase creation time in ISO 8601 format (UTC).
     */
    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * @param DisplayName|DisplayNameShape $displayName
     */
    public function withDisplayName(DisplayName|array $displayName): self
    {
        $self = clone $this;
        $self['displayName'] = $displayName;

        return $self;
    }

    /**
     * **E.164 International Format.** Phone number with country code prefix (e.g., `+12025550123` for US, `+79991234567` for Russia).
     *
     * **Usage.** This is your Telegram account login. Use it with `verification.code` and `verification.password` to access the account.
     */
    public function withPhoneNumber(string $phoneNumber): self
    {
        $self = clone $this;
        $self['phoneNumber'] = $phoneNumber;

        return $self;
    }

    /**
     * **Final Price After Discount.** The actual amount deducted from your balance, with your personal discount already applied.
     *
     * **To see pricing breakdown before purchase.** Check `GET /accounts/:country_code` which shows both discounted price and original `base_price`.
     *
     * **Discount eligibility.** Based on your total successful purchase count. Higher volume = bigger discounts.
     *
     * @param Price|PriceShape $price
     */
    public function withPrice(Price|array $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * **Purchase Status Lifecycle.** `PENDING` (initial) → `SUCCESS` (after code request) or `ERROR` (provider failure). Any status can transition to `REFUND` via admin action.
     *
     * **Important.** Status is immutable once set to `SUCCESS`, `ERROR`, or `REFUND`.
     *
     * **Filter options**
     * - `PENDING` - code not requested.
     * - `SUCCESS` - code ready.
     * - `ERROR` - provider failed.
     * - `REFUND` - money returned.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * **Verification Credentials.** Login credentials for the purchased Telegram account. Initially `null` after purchase creation.
     *
     * **Availability.** Populated after calling `POST /purchases/:id/request-code`. Once received, credentials are permanent and cannot be re-requested.
     *
     * **Security.** Verification data is only visible to the purchase owner.
     *
     * @param Verification|VerificationShape|null $verification
     */
    public function withVerification(
        Verification|array|null $verification
    ): self {
        $self = clone $this;
        $self['verification'] = $verification;

        return $self;
    }
}
