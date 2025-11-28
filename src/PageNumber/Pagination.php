<?php

declare(strict_types=1);

namespace GmtPhpSDK\PageNumber;

use GmtPhpSDK\Core\Attributes\Api;
use GmtPhpSDK\Core\Concerns\SdkModel;
use GmtPhpSDK\Core\Contracts\BaseModel;

/**
 * @phpstan-type PaginationShape = array{
 *   current_page: int, has_next: bool, total_pages: int
 * }
 */
final class Pagination implements BaseModel
{
    /** @use SdkModel<PaginationShape> */
    use SdkModel;

    #[Api]
    public int $current_page;

    #[Api]
    public bool $has_next;

    #[Api]
    public int $total_pages;

    /**
     * `new Pagination()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Pagination::with(current_page: ..., has_next: ..., total_pages: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Pagination)->withCurrentPage(...)->withHasNext(...)->withTotalPages(...)
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
        int $current_page,
        bool $has_next,
        int $total_pages
    ): self {
        $obj = new self;

        $obj->current_page = $current_page;
        $obj->has_next = $has_next;
        $obj->total_pages = $total_pages;

        return $obj;
    }

    public function withCurrentPage(int $currentPage): self
    {
        $obj = clone $this;
        $obj->current_page = $currentPage;

        return $obj;
    }

    public function withHasNext(bool $hasNext): self
    {
        $obj = clone $this;
        $obj->has_next = $hasNext;

        return $obj;
    }

    public function withTotalPages(int $totalPages): self
    {
        $obj = clone $this;
        $obj->total_pages = $totalPages;

        return $obj;
    }
}
