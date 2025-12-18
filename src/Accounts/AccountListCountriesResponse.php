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
 * @phpstan-import-type DisplayNameShape from \Gmt\Accounts\AccountListCountriesResponse\DisplayName
 * @phpstan-import-type PriceShape from \Gmt\Accounts\AccountListCountriesResponse\Price
 *
 * @phpstan-type AccountListCountriesResponseShape = array{
 *   available: bool,
 *   countryCode: string,
 *   displayName: DisplayName|DisplayNameShape,
 *   emoji: string,
 *   price: Price|PriceShape,
 *   tags: list<Tag|value-of<Tag>>,
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
    #[Required('country_code')]
    public string $countryCode;

    #[Required('display_name')]
    public DisplayName $displayName;

    /**
     * Country flag emoji.
     */
    #[Required]
    public string $emoji;

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
     *   available: ...,
     *   countryCode: ...,
     *   displayName: ...,
     *   emoji: ...,
     *   price: ...,
     *   tags: ...,
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
     *   ->withEmoji(...)
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
     * @param DisplayName|DisplayNameShape $displayName
     * @param Price|PriceShape $price
     * @param list<Tag|value-of<Tag>> $tags
     */
    public static function with(
        bool $available,
        string $countryCode,
        DisplayName|array $displayName,
        string $emoji,
        Price|array $price,
        array $tags,
    ): self {
        $self = new self;

        $self['available'] = $available;
        $self['countryCode'] = $countryCode;
        $self['displayName'] = $displayName;
        $self['emoji'] = $emoji;
        $self['price'] = $price;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Whether the country is available for purchase.
     */
    public function withAvailable(bool $available): self
    {
        $self = clone $this;
        $self['available'] = $available;

        return $self;
    }

    /**
     * Country code (ISO 3166-1 alpha-2).
     */
    public function withCountryCode(string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

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
     * Country flag emoji.
     */
    public function withEmoji(string $emoji): self
    {
        $self = clone $this;
        $self['emoji'] = $emoji;

        return $self;
    }

    /**
     * @param Price|PriceShape $price
     */
    public function withPrice(Price|array $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * Account tags (e.g., HIGH_QUALITY for premium accounts).
     *
     * @param list<Tag|value-of<Tag>> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }
}
