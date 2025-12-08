<?php

declare(strict_types=1);

namespace Gmt\Purchases;

use Gmt\Core\Attributes\Api;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;
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
 *   page: int, page_size: int, status?: Status|value-of<Status>
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
    #[Api]
    public int $page;

    /**
     * Number of items per page.
     */
    #[Api]
    public int $page_size;

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
    #[Api(enum: Status::class, optional: true)]
    public ?string $status;

    /**
     * `new PurchaseListParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchaseListParams::with(page: ..., page_size: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurchaseListParams)->withPage(...)->withPageSize(...)
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
        int $page = 1,
        int $page_size = 50,
        Status|string|null $status = null
    ): self {
        $obj = new self;

        $obj['page'] = $page;
        $obj['page_size'] = $page_size;

        null !== $status && $obj['status'] = $status;

        return $obj;
    }

    /**
     * Page number.
     */
    public function withPage(int $page): self
    {
        $obj = clone $this;
        $obj['page'] = $page;

        return $obj;
    }

    /**
     * Number of items per page.
     */
    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj['page_size'] = $pageSize;

        return $obj;
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
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }
}
