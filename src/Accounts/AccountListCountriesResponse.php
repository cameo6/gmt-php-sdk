<?php

declare(strict_types=1);

namespace Gmt\Accounts;

use Gmt\Accounts\AccountListCountriesResponse\DisplayName;
use Gmt\Accounts\AccountListCountriesResponse\Price;
use Gmt\Accounts\AccountListCountriesResponse\Tag;
use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type AccountListCountriesResponseShape = array{
 *   available: bool,
 *   country_code: string,
 *   display_name: DisplayName,
 *   price: Price,
 *   tags: list<value-of<Tag>>,
 * }
 */
final class AccountListCountriesResponse implements BaseModel
{
    /** @use SdkModel<AccountListCountriesResponseShape> */
    use SdkModel;

    /**
     * Whether the country is available for purchase.
     */
    #[Required]
    public bool $available;

    /**
     * Country code (ISO 3166-1 alpha-2).
     */
    #[Required]
    public string $country_code;

    #[Required]
    public DisplayName $display_name;

    #[Required]
    public Price $price;

    /**
     * Account tags (e.g., HIGH_QUALITY for premium accounts).
     *
     * @var list<value-of<Tag>> $tags
     */
    #[Required(list: Tag::class)]
    public array $tags;

    /**
     * `new AccountListCountriesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountListCountriesResponse::with(
     *   available: ..., country_code: ..., display_name: ..., price: ..., tags: ...
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
     *   ->withTags(...)
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
     * @param list<Tag|value-of<Tag>> $tags
     */
    public static function with(
        bool $available,
        string $country_code,
        DisplayName|array $display_name,
        Price|array $price,
        array $tags,
    ): self {
        $obj = new self;

        $obj['available'] = $available;
        $obj['country_code'] = $country_code;
        $obj['display_name'] = $display_name;
        $obj['price'] = $price;
        $obj['tags'] = $tags;

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

    /**
     * Account tags (e.g., HIGH_QUALITY for premium accounts).
     *
     * @param list<Tag|value-of<Tag>> $tags
     */
    public function withTags(array $tags): self
    {
        $obj = clone $this;
        $obj['tags'] = $tags;

        return $obj;
    }
}
