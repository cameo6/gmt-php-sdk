<?php

declare(strict_types=1);

namespace Gmt\Accounts;

use Gmt\Accounts\AccountListResponse\DisplayName;
use Gmt\Accounts\AccountListResponse\Price;
use Gmt\Accounts\AccountListResponse\Tag;
use Gmt\Core\Attributes\Optional;
use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type DisplayNameShape from \Gmt\Accounts\AccountListResponse\DisplayName
 * @phpstan-import-type PriceShape from \Gmt\Accounts\AccountListResponse\Price
 *
 * @phpstan-type AccountListResponseShape = array{
 *   available: bool,
 *   countryCode: string,
 *   displayName: DisplayName|DisplayNameShape,
 *   price: Price|PriceShape,
 *   tags: list<Tag|value-of<Tag>>,
 *   availableCount?: float|null,
 * }
 */
final class AccountListResponse implements BaseModel
{
    /** @use SdkModel<AccountListResponseShape> */
    use SdkModel;

    /**
     * Indicates if account is available for purchase.
     */
    #[Required]
    public bool $available;

    /**
     * ISO 3166-1 alpha-2 country code (e.g., US, RU, GB).
     */
    #[Required('country_code')]
    public string $countryCode;

    #[Required('display_name')]
    public DisplayName $displayName;

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
     * Number of available accounts for this country.
     */
    #[Optional('available_count', nullable: true)]
    public ?float $availableCount;

    /**
     * `new AccountListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountListResponse::with(
     *   available: ..., countryCode: ..., displayName: ..., price: ..., tags: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountListResponse)
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
     * @param DisplayName|DisplayNameShape $displayName
     * @param Price|PriceShape $price
     * @param list<Tag|value-of<Tag>> $tags
     */
    public static function with(
        bool $available,
        string $countryCode,
        DisplayName|array $displayName,
        Price|array $price,
        array $tags,
        ?float $availableCount = null,
    ): self {
        $self = new self;

        $self['available'] = $available;
        $self['countryCode'] = $countryCode;
        $self['displayName'] = $displayName;
        $self['price'] = $price;
        $self['tags'] = $tags;

        null !== $availableCount && $self['availableCount'] = $availableCount;

        return $self;
    }

    /**
     * Indicates if account is available for purchase.
     */
    public function withAvailable(bool $available): self
    {
        $self = clone $this;
        $self['available'] = $available;

        return $self;
    }

    /**
     * ISO 3166-1 alpha-2 country code (e.g., US, RU, GB).
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

    /**
     * Number of available accounts for this country.
     */
    public function withAvailableCount(?float $availableCount): self
    {
        $self = clone $this;
        $self['availableCount'] = $availableCount;

        return $self;
    }
}
