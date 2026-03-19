<?php

declare(strict_types=1);

namespace Gmt\Profile\Discount\DiscountGetResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type CustomDiscountShape = array{
 *   id: int,
 *   countryCode: string|null,
 *   createdAt: string,
 *   discountPercent: float,
 *   expiresAt: string|null,
 * }
 */
final class CustomDiscount implements BaseModel
{
    /** @use SdkModel<CustomDiscountShape> */
    use SdkModel;

    /**
     * Custom discount rule ID.
     */
    #[Required]
    public int $id;

    /**
     * ISO 3166-1 alpha-2 country code. If null, applies to all countries.
     */
    #[Required('country_code')]
    public ?string $countryCode;

    /**
     * Creation date in ISO 8601 format (UTC).
     */
    #[Required('created_at')]
    public string $createdAt;

    /**
     * Discount percentage.
     */
    #[Required('discount_percent')]
    public float $discountPercent;

    /**
     * Expiration date in ISO 8601 format (UTC). If null, never expires.
     */
    #[Required('expires_at')]
    public ?string $expiresAt;

    /**
     * `new CustomDiscount()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CustomDiscount::with(
     *   id: ...,
     *   countryCode: ...,
     *   createdAt: ...,
     *   discountPercent: ...,
     *   expiresAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CustomDiscount)
     *   ->withID(...)
     *   ->withCountryCode(...)
     *   ->withCreatedAt(...)
     *   ->withDiscountPercent(...)
     *   ->withExpiresAt(...)
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
        int $id,
        ?string $countryCode,
        string $createdAt,
        float $discountPercent,
        ?string $expiresAt,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['countryCode'] = $countryCode;
        $self['createdAt'] = $createdAt;
        $self['discountPercent'] = $discountPercent;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Custom discount rule ID.
     */
    public function withID(int $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * ISO 3166-1 alpha-2 country code. If null, applies to all countries.
     */
    public function withCountryCode(?string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * Creation date in ISO 8601 format (UTC).
     */
    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Discount percentage.
     */
    public function withDiscountPercent(float $discountPercent): self
    {
        $self = clone $this;
        $self['discountPercent'] = $discountPercent;

        return $self;
    }

    /**
     * Expiration date in ISO 8601 format (UTC). If null, never expires.
     */
    public function withExpiresAt(?string $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }
}
