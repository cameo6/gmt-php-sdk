<?php

declare(strict_types=1);

namespace Gmt\Purchases\Bulk;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Purchases\Bulk\BulkGetResponse\Item;
use Gmt\Purchases\Bulk\BulkGetResponse\PricePerAccount;
use Gmt\Purchases\Bulk\BulkGetResponse\Status;
use Gmt\Purchases\Bulk\BulkGetResponse\TotalPrice;

/**
 * @phpstan-import-type ItemShape from \Gmt\Purchases\Bulk\BulkGetResponse\Item
 * @phpstan-import-type PricePerAccountShape from \Gmt\Purchases\Bulk\BulkGetResponse\PricePerAccount
 * @phpstan-import-type TotalPriceShape from \Gmt\Purchases\Bulk\BulkGetResponse\TotalPrice
 *
 * @phpstan-type BulkGetResponseShape = array{
 *   bulkPurchaseID: int,
 *   countryCode: string,
 *   createdAt: string,
 *   item: null|Item|ItemShape,
 *   pricePerAccount: PricePerAccount|PricePerAccountShape,
 *   quantity: int,
 *   status: Status|value-of<Status>,
 *   totalPrice: TotalPrice|TotalPriceShape,
 *   updatedAt: string,
 * }
 */
final class BulkGetResponse implements BaseModel
{
    /** @use SdkModel<BulkGetResponseShape> */
    use SdkModel;

    /**
     * Unique ID of the bulk purchase request.
     */
    #[Required('bulk_purchase_id')]
    public int $bulkPurchaseID;

    /**
     * ISO 3166-1 alpha-2 country code.
     */
    #[Required('country_code')]
    public string $countryCode;

    /**
     * Bulk purchase creation timestamp.
     */
    #[Required('created_at')]
    public string $createdAt;

    /**
     * Archive data (only populated when status is SUCCESS).
     */
    #[Required]
    public ?Item $item;

    /**
     * Price of a single account.
     */
    #[Required('price_per_account')]
    public PricePerAccount $pricePerAccount;

    /**
     * Number of accounts in this purchase.
     */
    #[Required]
    public int $quantity;

    /**
     * Current status of bulk purchase.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Total price for all accounts.
     */
    #[Required('total_price')]
    public TotalPrice $totalPrice;

    /**
     * Last update timestamp.
     */
    #[Required('updated_at')]
    public string $updatedAt;

    /**
     * `new BulkGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkGetResponse::with(
     *   bulkPurchaseID: ...,
     *   countryCode: ...,
     *   createdAt: ...,
     *   item: ...,
     *   pricePerAccount: ...,
     *   quantity: ...,
     *   status: ...,
     *   totalPrice: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkGetResponse)
     *   ->withBulkPurchaseID(...)
     *   ->withCountryCode(...)
     *   ->withCreatedAt(...)
     *   ->withItem(...)
     *   ->withPricePerAccount(...)
     *   ->withQuantity(...)
     *   ->withStatus(...)
     *   ->withTotalPrice(...)
     *   ->withUpdatedAt(...)
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
     * @param Item|ItemShape|null $item
     * @param PricePerAccount|PricePerAccountShape $pricePerAccount
     * @param Status|value-of<Status> $status
     * @param TotalPrice|TotalPriceShape $totalPrice
     */
    public static function with(
        int $bulkPurchaseID,
        string $countryCode,
        string $createdAt,
        Item|array|null $item,
        PricePerAccount|array $pricePerAccount,
        int $quantity,
        Status|string $status,
        TotalPrice|array $totalPrice,
        string $updatedAt,
    ): self {
        $self = new self;

        $self['bulkPurchaseID'] = $bulkPurchaseID;
        $self['countryCode'] = $countryCode;
        $self['createdAt'] = $createdAt;
        $self['item'] = $item;
        $self['pricePerAccount'] = $pricePerAccount;
        $self['quantity'] = $quantity;
        $self['status'] = $status;
        $self['totalPrice'] = $totalPrice;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Unique ID of the bulk purchase request.
     */
    public function withBulkPurchaseID(int $bulkPurchaseID): self
    {
        $self = clone $this;
        $self['bulkPurchaseID'] = $bulkPurchaseID;

        return $self;
    }

    /**
     * ISO 3166-1 alpha-2 country code.
     */
    public function withCountryCode(string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * Bulk purchase creation timestamp.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Archive data (only populated when status is SUCCESS).
     *
     * @param Item|ItemShape|null $item
     */
    public function withItem(Item|array|null $item): self
    {
        $self = clone $this;
        $self['item'] = $item;

        return $self;
    }

    /**
     * Price of a single account.
     *
     * @param PricePerAccount|PricePerAccountShape $pricePerAccount
     */
    public function withPricePerAccount(
        PricePerAccount|array $pricePerAccount
    ): self {
        $self = clone $this;
        $self['pricePerAccount'] = $pricePerAccount;

        return $self;
    }

    /**
     * Number of accounts in this purchase.
     */
    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * Current status of bulk purchase.
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
     * Total price for all accounts.
     *
     * @param TotalPrice|TotalPriceShape $totalPrice
     */
    public function withTotalPrice(TotalPrice|array $totalPrice): self
    {
        $self = clone $this;
        $self['totalPrice'] = $totalPrice;

        return $self;
    }

    /**
     * Last update timestamp.
     */
    public function withUpdatedAt(string $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
