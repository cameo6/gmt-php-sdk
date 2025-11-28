<?php

declare(strict_types=1);

namespace GmtPhpSDK\Accounts;

use GmtPhpSDK\Accounts\AccountGetResponse\Discount;
use GmtPhpSDK\Accounts\AccountGetResponse\DisplayName;
use GmtPhpSDK\Accounts\AccountGetResponse\Price;
use GmtPhpSDK\Core\Attributes\Api;
use GmtPhpSDK\Core\Concerns\SdkModel;
use GmtPhpSDK\Core\Concerns\SdkResponse;
use GmtPhpSDK\Core\Contracts\BaseModel;
use GmtPhpSDK\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type AccountGetResponseShape = array{
 *   available: bool,
 *   country_code: string,
 *   discount: Discount,
 *   display_name: DisplayName,
 *   price: Price,
 * }
 */
final class AccountGetResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<AccountGetResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Indicates if account is available for purchase.
     */
    #[Api]
    public bool $available;

    /**
     * ISO 3166-1 alpha-2 country code (e.g., US, RU, GB).
     */
    #[Api]
    public string $country_code;

    #[Api]
    public Discount $discount;

    #[Api]
    public DisplayName $display_name;

    #[Api]
    public Price $price;

    /**
     * `new AccountGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountGetResponse::with(
     *   available: ...,
     *   country_code: ...,
     *   discount: ...,
     *   display_name: ...,
     *   price: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountGetResponse)
     *   ->withAvailable(...)
     *   ->withCountryCode(...)
     *   ->withDiscount(...)
     *   ->withDisplayName(...)
     *   ->withPrice(...)
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
     */
    public static function with(
        bool $available,
        string $country_code,
        Discount $discount,
        DisplayName $display_name,
        Price $price,
    ): self {
        $obj = new self;

        $obj->available = $available;
        $obj->country_code = $country_code;
        $obj->discount = $discount;
        $obj->display_name = $display_name;
        $obj->price = $price;

        return $obj;
    }

    /**
     * Indicates if account is available for purchase.
     */
    public function withAvailable(bool $available): self
    {
        $obj = clone $this;
        $obj->available = $available;

        return $obj;
    }

    /**
     * ISO 3166-1 alpha-2 country code (e.g., US, RU, GB).
     */
    public function withCountryCode(string $countryCode): self
    {
        $obj = clone $this;
        $obj->country_code = $countryCode;

        return $obj;
    }

    public function withDiscount(Discount $discount): self
    {
        $obj = clone $this;
        $obj->discount = $discount;

        return $obj;
    }

    public function withDisplayName(DisplayName $displayName): self
    {
        $obj = clone $this;
        $obj->display_name = $displayName;

        return $obj;
    }

    public function withPrice(Price $price): self
    {
        $obj = clone $this;
        $obj->price = $price;

        return $obj;
    }
}
