<?php

declare(strict_types=1);

namespace Gmt\Purchases\PurchaseRefundResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Purchases\PurchaseRefundResponse\Purchase\DisplayName;
use Gmt\Purchases\PurchaseRefundResponse\Purchase\Price;
use Gmt\Purchases\PurchaseRefundResponse\Purchase\Status;
use Gmt\Purchases\PurchaseRefundResponse\Purchase\Verification;

/**
 * @phpstan-type PurchaseShape = array{
 *   id: int,
 *   countryCode: string,
 *   createdAt: string,
 *   displayName: DisplayName,
 *   phoneNumber: string,
 *   price: Price,
 *   status: value-of<Status>,
 *   verification: Verification|null,
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
     * @param DisplayName|array{en: string, ru: string} $displayName
     * @param Price|array{amount: string, currencyCode: string} $price
     * @param Status|value-of<Status> $status
     * @param Verification|array{
     *   code: string, password: string, receivedAt: string
     * }|null $verification
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
        $obj = new self;

        $obj['id'] = $id;
        $obj['countryCode'] = $countryCode;
        $obj['createdAt'] = $createdAt;
        $obj['displayName'] = $displayName;
        $obj['phoneNumber'] = $phoneNumber;
        $obj['price'] = $price;
        $obj['status'] = $status;
        $obj['verification'] = $verification;

        return $obj;
    }

    /**
     * Unique purchase identifier.
     */
    public function withID(int $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * ISO 3166-1 alpha-2 country code.
     */
    public function withCountryCode(string $countryCode): self
    {
        $obj = clone $this;
        $obj['countryCode'] = $countryCode;

        return $obj;
    }

    /**
     * Purchase creation time in ISO 8601 format (UTC).
     */
    public function withCreatedAt(string $createdAt): self
    {
        $obj = clone $this;
        $obj['createdAt'] = $createdAt;

        return $obj;
    }

    /**
     * @param DisplayName|array{en: string, ru: string} $displayName
     */
    public function withDisplayName(DisplayName|array $displayName): self
    {
        $obj = clone $this;
        $obj['displayName'] = $displayName;

        return $obj;
    }

    /**
     * **E.164 International Format.** Phone number with country code prefix (e.g., `+12025550123` for US, `+79991234567` for Russia).
     *
     * **Usage.** This is your Telegram account login. Use it with `verification.code` and `verification.password` to access the account.
     */
    public function withPhoneNumber(string $phoneNumber): self
    {
        $obj = clone $this;
        $obj['phoneNumber'] = $phoneNumber;

        return $obj;
    }

    /**
     * **Final Price After Discount.** The actual amount deducted from your balance, with your personal discount already applied.
     *
     * **To see pricing breakdown before purchase.** Check `GET /accounts/:country_code` which shows both discounted price and original `base_price`.
     *
     * **Discount eligibility.** Based on your total successful purchase count. Higher volume = bigger discounts.
     *
     * @param Price|array{amount: string, currencyCode: string} $price
     */
    public function withPrice(Price|array $price): self
    {
        $obj = clone $this;
        $obj['price'] = $price;

        return $obj;
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
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * **Verification Credentials.** Login credentials for the purchased Telegram account. Initially `null` after purchase creation.
     *
     * **Availability.** Populated after calling `POST /purchases/:id/request-code`. Once received, credentials are permanent and cannot be re-requested.
     *
     * **Security.** Verification data is only visible to the purchase owner.
     *
     * @param Verification|array{
     *   code: string, password: string, receivedAt: string
     * }|null $verification
     */
    public function withVerification(
        Verification|array|null $verification
    ): self {
        $obj = clone $this;
        $obj['verification'] = $verification;

        return $obj;
    }
}
