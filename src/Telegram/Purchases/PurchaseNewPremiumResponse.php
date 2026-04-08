<?php

declare(strict_types=1);

namespace Gmt\Telegram\Purchases;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Telegram\Purchases\PurchaseNewPremiumResponse\Status;

/**
 * @phpstan-type PurchaseNewPremiumResponseShape = array{
 *   mounts: float, price: float, status: Status|value-of<Status>, username: string
 * }
 */
final class PurchaseNewPremiumResponse implements BaseModel
{
    /** @use SdkModel<PurchaseNewPremiumResponseShape> */
    use SdkModel;

    /**
     * The number of months for the premium subscription (3, 6, or 12).
     */
    #[Required]
    public float $mounts;

    /**
     * The price of the premium subscription.
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
     * `new PurchaseNewPremiumResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchaseNewPremiumResponse::with(
     *   mounts: ..., price: ..., status: ..., username: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurchaseNewPremiumResponse)
     *   ->withMounts(...)
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
        float $mounts,
        float $price,
        Status|string $status,
        string $username
    ): self {
        $self = new self;

        $self['mounts'] = $mounts;
        $self['price'] = $price;
        $self['status'] = $status;
        $self['username'] = $username;

        return $self;
    }

    /**
     * The number of months for the premium subscription (3, 6, or 12).
     */
    public function withMounts(float $mounts): self
    {
        $self = clone $this;
        $self['mounts'] = $mounts;

        return $self;
    }

    /**
     * The price of the premium subscription.
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
