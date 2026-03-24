<?php

declare(strict_types=1);

namespace Gmt\Purchases;

use Gmt\Core\Attributes\Optional;
use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Purchases\PurchaseListParams\Sort;
use Gmt\Purchases\PurchaseListParams\Status;

/**
 * Returns paginated list of user's purchases with optional status filtering.
 *
 * **Chronological Ordering.** Purchases are always returned **newest first** (descending by `created_at`).
 *
 * **Pagination behavior**
 * - Results are consistent during session (no duplicates or missing items when paginating).
 * - `has_next: true` indicates more pages available.
 * - Maximum `page_size` is 50 items.
 *
 * **Filtering.** Combine `status` filter with pagination for subset queries (e.g., all successful purchases).
 *
 * @see Gmt\Services\PurchasesService::list()
 *
 * @phpstan-type PurchaseListParamsShape = array{
 *   page: int,
 *   pageSize: int,
 *   sort: Sort|value-of<Sort>,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class PurchaseListParams implements BaseModel
{
    /** @use SdkModel<PurchaseListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Page number.
     */
    #[Required]
    public int $page;

    /**
     * Number of items per page.
     */
    #[Required]
    public int $pageSize;

    /**
     * Sort purchases by creation date.
     *
     * @var value-of<Sort> $sort
     */
    #[Required(enum: Sort::class)]
    public string $sort;

    /**
     * **Purchase Status Lifecycle.** `PENDING` (initial) → `SUCCESS` (after code request) or `ERROR` (provider failure). Any status can transition to `REFUND` via admin action.
     *
     * **Important.** Status is immutable once set to `SUCCESS`, `ERROR`, or `REFUND`.
     *
     * **Filter options**
     * - `PENDING` - code not requested.
     * - `SUCCESS` - code ready.
     * - `ERROR` - provider failed.
     * - `REFUND` - money returned.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * `new PurchaseListParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchaseListParams::with(page: ..., pageSize: ..., sort: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurchaseListParams)->withPage(...)->withPageSize(...)->withSort(...)
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
     * @param Sort|value-of<Sort> $sort
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        int $page = 1,
        int $pageSize = 50,
        Sort|string $sort = 'date_desc',
        Status|string|null $status = null,
    ): self {
        $self = new self;

        $self['page'] = $page;
        $self['pageSize'] = $pageSize;
        $self['sort'] = $sort;

        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Page number.
     */
    public function withPage(int $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

        return $self;
    }

    /**
     * Number of items per page.
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Sort purchases by creation date.
     *
     * @param Sort|value-of<Sort> $sort
     */
    public function withSort(Sort|string $sort): self
    {
        $self = clone $this;
        $self['sort'] = $sort;

        return $self;
    }

    /**
     * **Purchase Status Lifecycle.** `PENDING` (initial) → `SUCCESS` (after code request) or `ERROR` (provider failure). Any status can transition to `REFUND` via admin action.
     *
     * **Important.** Status is immutable once set to `SUCCESS`, `ERROR`, or `REFUND`.
     *
     * **Filter options**
     * - `PENDING` - code not requested.
     * - `SUCCESS` - code ready.
     * - `ERROR` - provider failed.
     * - `REFUND` - money returned.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
