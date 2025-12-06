<?php

declare(strict_types=1);

namespace Gmt\Purchases;

use Gmt\Core\Attributes\Api;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkResponse;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Core\Conversion\Contracts\ResponseConverter;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\DisplayName;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\Price;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\Status;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\Verification;

/**
 * @phpstan-type PurchaseRequestVerificationCodeResponseShape = array{
 *   id: int,
 *   country_code: string,
 *   created_at: string,
 *   display_name: DisplayName,
 *   phone_number: string,
 *   price: Price,
 *   status: value-of<Status>,
 *   verification: Verification|null,
 * }
 */
final class PurchaseRequestVerificationCodeResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<PurchaseRequestVerificationCodeResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Unique purchase identifier.
     */
    #[Api]
    public int $id;

    /**
     * ISO 3166-1 alpha-2 country code.
     */
    #[Api]
    public string $country_code;

    /**
     * Purchase creation time in ISO 8601 format (UTC).
     */
    #[Api]
    public string $created_at;

    #[Api]
    public DisplayName $display_name;

    /**
     * **E.164 International Format.** Phone number with country code prefix (e.g., `+12025550123` for US, `+79991234567` for Russia).
     *
     * **Usage.** This is your Telegram account login. Use it with `verification.code` and `verification.password` to access the account.
     */
    #[Api]
    public string $phone_number;

    /**
     * **Final Price After Discount.** The actual amount deducted from your balance, with your personal discount already applied.
     *
     * **To see pricing breakdown before purchase.** Check `GET /accounts/:country_code` which shows both discounted price and original `base_price`.
     *
     * **Discount eligibility.** Based on your total successful purchase count. Higher volume = bigger discounts.
     */
    #[Api]
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
    #[Api(enum: Status::class)]
    public string $status;

    /**
     * **Verification Credentials.** Login credentials for the purchased Telegram account. Initially `null` after purchase creation.
     *
     * **Availability.** Populated after calling `POST /purchases/:id/request-code`. Once received, credentials are permanent and cannot be re-requested.
     *
     * **Security.** Verification data is only visible to the purchase owner.
     */
    #[Api]
    public ?Verification $verification;

    /**
     * `new PurchaseRequestVerificationCodeResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchaseRequestVerificationCodeResponse::with(
     *   id: ...,
     *   country_code: ...,
     *   created_at: ...,
     *   display_name: ...,
     *   phone_number: ...,
     *   price: ...,
     *   status: ...,
     *   verification: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurchaseRequestVerificationCodeResponse)
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
     * @param DisplayName|array{en: string, ru: string} $display_name
     * @param Price|array{amount: string, currency_code: string} $price
     * @param Status|value-of<Status> $status
     * @param Verification|array{
     *   code: string, password: string, received_at: string
     * }|null $verification
     */
    public static function with(
        int $id,
        string $country_code,
        string $created_at,
        DisplayName|array $display_name,
        string $phone_number,
        Price|array $price,
        Status|string $status,
        Verification|array|null $verification,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['country_code'] = $country_code;
        $obj['created_at'] = $created_at;
        $obj['display_name'] = $display_name;
        $obj['phone_number'] = $phone_number;
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
        $obj['country_code'] = $countryCode;

        return $obj;
    }

    /**
     * Purchase creation time in ISO 8601 format (UTC).
     */
    public function withCreatedAt(string $createdAt): self
    {
        $obj = clone $this;
        $obj['created_at'] = $createdAt;

        return $obj;
    }

    /**
     * @param DisplayName|array{en: string, ru: string} $displayName
     */
    public function withDisplayName(DisplayName|array $displayName): self
    {
        $obj = clone $this;
        $obj['display_name'] = $displayName;

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
        $obj['phone_number'] = $phoneNumber;

        return $obj;
    }

    /**
     * **Final Price After Discount.** The actual amount deducted from your balance, with your personal discount already applied.
     *
     * **To see pricing breakdown before purchase.** Check `GET /accounts/:country_code` which shows both discounted price and original `base_price`.
     *
     * **Discount eligibility.** Based on your total successful purchase count. Higher volume = bigger discounts.
     *
     * @param Price|array{amount: string, currency_code: string} $price
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
     *   code: string, password: string, received_at: string
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
