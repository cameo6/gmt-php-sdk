<?php

declare(strict_types=1);

namespace Gmt\Accounts;

use Gmt\Accounts\AccountListCountriesResponse\DisplayName;
use Gmt\Accounts\AccountListCountriesResponse\Price;
use Gmt\Core\Attributes\Api;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkResponse;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type AccountListCountriesResponseShape = array{
 *   available: bool, country_code: string, display_name: DisplayName, price: Price
 * }
 */
final class AccountListCountriesResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<AccountListCountriesResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Whether the country is available for purchase.
     */
    #[Api]
    public bool $available;

    /**
     * Country code (ISO 3166-1 alpha-2).
     */
    #[Api]
    public string $country_code;

    #[Api]
    public DisplayName $display_name;

    #[Api]
    public Price $price;

    /**
     * `new AccountListCountriesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountListCountriesResponse::with(
     *   available: ..., country_code: ..., display_name: ..., price: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountListCountriesResponse)
     *   ->withAvailable(...)
     *   ->withCountryCode(...)
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
     * @param DisplayName|array{en: string, ru: string} $display_name
     * @param Price|array{amount: string, currency_code: string} $price
     */
    public static function with(
        bool $available,
        string $country_code,
        DisplayName|array $display_name,
        Price|array $price,
    ): self {
        $obj = new self;

        $obj['available'] = $available;
        $obj['country_code'] = $country_code;
        $obj['display_name'] = $display_name;
        $obj['price'] = $price;

        return $obj;
    }

    /**
     * Whether the country is available for purchase.
     */
    public function withAvailable(bool $available): self
    {
        $obj = clone $this;
        $obj['available'] = $available;

        return $obj;
    }

    /**
     * Country code (ISO 3166-1 alpha-2).
     */
    public function withCountryCode(string $countryCode): self
    {
        $obj = clone $this;
        $obj['country_code'] = $countryCode;

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
