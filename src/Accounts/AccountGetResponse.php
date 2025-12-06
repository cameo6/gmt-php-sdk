<?php

declare(strict_types=1);

namespace Gmt\Accounts;

use Gmt\Accounts\AccountGetResponse\Discount;
use Gmt\Accounts\AccountGetResponse\DisplayName;
use Gmt\Accounts\AccountGetResponse\Price;
use Gmt\Core\Attributes\Api;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkResponse;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Core\Conversion\Contracts\ResponseConverter;

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
     *
     * @param Discount|array{base_price: string, percent: float} $discount
     * @param DisplayName|array{en: string, ru: string} $display_name
     * @param Price|array{amount: string, currency_code: string} $price
     */
    public static function with(
        bool $available,
        string $country_code,
        Discount|array $discount,
        DisplayName|array $display_name,
        Price|array $price,
    ): self {
        $obj = new self;

        $obj['available'] = $available;
        $obj['country_code'] = $country_code;
        $obj['discount'] = $discount;
        $obj['display_name'] = $display_name;
        $obj['price'] = $price;

        return $obj;
    }

    /**
     * Indicates if account is available for purchase.
     */
    public function withAvailable(bool $available): self
    {
        $obj = clone $this;
        $obj['available'] = $available;

        return $obj;
    }

    /**
     * ISO 3166-1 alpha-2 country code (e.g., US, RU, GB).
     */
    public function withCountryCode(string $countryCode): self
    {
        $obj = clone $this;
        $obj['country_code'] = $countryCode;

        return $obj;
    }

    /**
     * @param Discount|array{base_price: string, percent: float} $discount
     */
    public function withDiscount(Discount|array $discount): self
    {
        $obj = clone $this;
        $obj['discount'] = $discount;

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
     * @param Price|array{amount: string, currency_code: string} $price
     */
    public function withPrice(Price|array $price): self
    {
        $obj = clone $this;
        $obj['price'] = $price;

        return $obj;
    }
}
