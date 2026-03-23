<?php

declare(strict_types=1);

namespace Gmt\Accounts;

use Gmt\Accounts\AccountGetResponse\Discount;
use Gmt\Accounts\AccountGetResponse\DisplayName;
use Gmt\Accounts\AccountGetResponse\Price;
use Gmt\Accounts\AccountGetResponse\Tag;
use Gmt\Core\Attributes\Optional;
use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type DiscountShape from \Gmt\Accounts\AccountGetResponse\Discount
 * @phpstan-import-type DisplayNameShape from \Gmt\Accounts\AccountGetResponse\DisplayName
 * @phpstan-import-type PriceShape from \Gmt\Accounts\AccountGetResponse\Price
 *
 * @phpstan-type AccountGetResponseShape = array{
 *   available: bool,
 *   countryCode: string,
 *   discount: Discount|DiscountShape,
 *   displayName: DisplayName|DisplayNameShape,
 *   emoji: string,
 *   price: Price|PriceShape,
 *   tags: list<Tag|value-of<Tag>>,
 *   availableCount?: float|null,
 * }
 */
final class AccountGetResponse implements BaseModel
{
    /** @use SdkModel<AccountGetResponseShape> */
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

    #[Required]
    public Discount $discount;

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
     * Number of available accounts for this country.
     */
    #[Optional('available_count', nullable: true)]
    public ?float $availableCount;

    /**
     * `new AccountGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountGetResponse::with(
     *   available: ...,
     *   countryCode: ...,
     *   discount: ...,
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
     * (new AccountGetResponse)
     *   ->withAvailable(...)
     *   ->withCountryCode(...)
     *   ->withDiscount(...)
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
     * @param Discount|DiscountShape $discount
     * @param DisplayName|DisplayNameShape $displayName
     * @param Price|PriceShape $price
     * @param list<Tag|value-of<Tag>> $tags
     */
    public static function with(
        bool $available,
        string $countryCode,
        Discount|array $discount,
        DisplayName|array $displayName,
        string $emoji,
        Price|array $price,
        array $tags,
        ?float $availableCount = null,
    ): self {
        $self = new self;

        $self['available'] = $available;
        $self['countryCode'] = $countryCode;
        $self['discount'] = $discount;
        $self['displayName'] = $displayName;
        $self['emoji'] = $emoji;
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
     * @param Discount|DiscountShape $discount
     */
    public function withDiscount(Discount|array $discount): self
    {
        $self = clone $this;
        $self['discount'] = $discount;

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
