<?php

declare(strict_types=1);

namespace Gmt\Purchases\Bulk\BulkNewResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Purchases\Bulk\BulkNewResponse\Item\Status;

/**
 * Archive data (only populated when status is SUCCESS).
 *
 * @phpstan-type ItemShape = array{
 *   archiveURL: string,
 *   createdAt: string,
 *   exportID: string,
 *   quantity: int,
 *   status: \Gmt\Purchases\Bulk\BulkNewResponse\Item\Status|value-of<\Gmt\Purchases\Bulk\BulkNewResponse\Item\Status>,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    /**
     * Path or URL to download the archive with accounts.
     */
    #[Required('archive_url')]
    public string $archiveURL;

    /**
     * Bulk purchase creation timestamp.
     */
    #[Required('created_at')]
    public string $createdAt;

    /**
     * Archive/export ID with sessions.
     */
    #[Required('export_id')]
    public string $exportID;

    /**
     * Number of accounts in the archive.
     */
    #[Required]
    public int $quantity;

    /**
     * Status of bulk purchase.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(
     *   archiveURL: ..., createdAt: ..., exportID: ..., quantity: ..., status: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)
     *   ->withArchiveURL(...)
     *   ->withCreatedAt(...)
     *   ->withExportID(...)
     *   ->withQuantity(...)
     *   ->withStatus(...)
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
        string $archiveURL,
        string $createdAt,
        string $exportID,
        int $quantity,
        Status|string $status,
    ): self {
        $self = new self;

        $self['archiveURL'] = $archiveURL;
        $self['createdAt'] = $createdAt;
        $self['exportID'] = $exportID;
        $self['quantity'] = $quantity;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Path or URL to download the archive with accounts.
     */
    public function withArchiveURL(string $archiveURL): self
    {
        $self = clone $this;
        $self['archiveURL'] = $archiveURL;

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
     * Archive/export ID with sessions.
     */
    public function withExportID(string $exportID): self
    {
        $self = clone $this;
        $self['exportID'] = $exportID;

        return $self;
    }

    /**
     * Number of accounts in the archive.
     */
    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * Status of bulk purchase.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(
        Status|string $status
    ): self {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
