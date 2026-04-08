<?php

declare(strict_types=1);

namespace Gmt\Telegram\Purchases;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Telegram\Purchases\PurchaseNewStarsResponse\Status;

/**
 * @phpstan-type PurchaseNewStarsResponseShape = array{
 *   amount: float, price: float, status: Status|value-of<Status>, username: string
 * }
 */
final class PurchaseNewStarsResponse implements BaseModel
{
    /** @use SdkModel<PurchaseNewStarsResponseShape> */
    use SdkModel;

    /**
     * The amount of stars to purchase (50-10000).
     */
    #[Required]
    public float $amount;

    /**
     * The price of the stars.
     */
    #[Required]
    public float $price;

    /**
     * The status of the purchase.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * The username of the recipient.
     */
    #[Required]
    public string $username;

    /**
     * `new PurchaseNewStarsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchaseNewStarsResponse::with(
     *   amount: ..., price: ..., status: ..., username: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurchaseNewStarsResponse)
     *   ->withAmount(...)
     *   ->withPrice(...)
     *   ->withStatus(...)
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
     *
     * @param Status|value-of<Status> $status
     */
    public static function with(
        float $amount,
        float $price,
        Status|string $status,
        string $username
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['price'] = $price;
        $self['status'] = $status;
        $self['username'] = $username;

        return $self;
    }

    /**
     * The amount of stars to purchase (50-10000).
     */
    public function withAmount(float $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The price of the stars.
     */
    public function withPrice(float $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * The status of the purchase.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

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
