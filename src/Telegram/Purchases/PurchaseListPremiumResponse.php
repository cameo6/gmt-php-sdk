<?php

declare(strict_types=1);

namespace Gmt\Telegram\Purchases;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type PurchaseListPremiumResponseShape = array{
 *   id: float, createdAt: string, mounts: float, price: float, username: string
 * }
 */
final class PurchaseListPremiumResponse implements BaseModel
{
    /** @use SdkModel<PurchaseListPremiumResponseShape> */
    use SdkModel;

    /**
     * The ID of the purchase.
     */
    #[Required]
    public float $id;

    /**
     * The date and time when the purchase was made.
     */
    #[Required('created_at')]
    public string $createdAt;

    /**
     * The number of months for the premium subscription.
     */
    #[Required]
    public float $mounts;

    /**
     * The price of the purchase.
     */
    #[Required]
    public float $price;

    /**
     * The username of the recipient.
     */
    #[Required]
    public string $username;

    /**
     * `new PurchaseListPremiumResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchaseListPremiumResponse::with(
     *   id: ..., createdAt: ..., mounts: ..., price: ..., username: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurchaseListPremiumResponse)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withMounts(...)
     *   ->withPrice(...)
     *   ->withUsername(...)
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
        float $id,
        string $createdAt,
        float $mounts,
        float $price,
        string $username
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['mounts'] = $mounts;
        $self['price'] = $price;
        $self['username'] = $username;

        return $self;
    }

    /**
     * The ID of the purchase.
     */
    public function withID(float $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The date and time when the purchase was made.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The number of months for the premium subscription.
     */
    public function withMounts(float $mounts): self
    {
        $self = clone $this;
        $self['mounts'] = $mounts;

        return $self;
    }

    /**
     * The price of the purchase.
     */
    public function withPrice(float $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * The username of the recipient.
     */
    public function withUsername(string $username): self
    {
        $self = clone $this;
        $self['username'] = $username;

        return $self;
    }
}
