<?php

declare(strict_types=1);

namespace Gmt\Telegram\Purchases;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type PurchaseListStarsResponseShape = array{
 *   id: float, amount: float, createdAt: string, price: float, username: string
 * }
 */
final class PurchaseListStarsResponse implements BaseModel
{
    /** @use SdkModel<PurchaseListStarsResponseShape> */
    use SdkModel;

    /**
     * The ID of the purchase.
     */
    #[Required]
    public float $id;

    /**
     * The amount of stars purchased.
     */
    #[Required]
    public float $amount;

    /**
     * The date and time when the purchase was made.
     */
    #[Required('created_at')]
    public string $createdAt;

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
     * `new PurchaseListStarsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchaseListStarsResponse::with(
     *   id: ..., amount: ..., createdAt: ..., price: ..., username: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurchaseListStarsResponse)
     *   ->withID(...)
     *   ->withAmount(...)
     *   ->withCreatedAt(...)
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
        float $amount,
        string $createdAt,
        float $price,
        string $username
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['amount'] = $amount;
        $self['createdAt'] = $createdAt;
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
     * The amount of stars purchased.
     */
    public function withAmount(float $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

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
