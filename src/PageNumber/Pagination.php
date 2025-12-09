<?php

declare(strict_types=1);

namespace Gmt\PageNumber;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type PaginationShape = array{
 *   currentPage: int, hasNext: bool, totalPages: int
 * }
 */
final class Pagination implements BaseModel
{
    /** @use SdkModel<PaginationShape> */
    use SdkModel;

    #[Required('current_page')]
    public int $currentPage;

    #[Required('has_next')]
    public bool $hasNext;

    #[Required('total_pages')]
    public int $totalPages;

    /**
     * `new Pagination()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Pagination::with(currentPage: ..., hasNext: ..., totalPages: ...)
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
        int $currentPage,
        bool $hasNext,
        int $totalPages
    ): self {
        $obj = new self;

        $obj['currentPage'] = $currentPage;
        $obj['hasNext'] = $hasNext;
        $obj['totalPages'] = $totalPages;

        return $obj;
    }

    public function withCurrentPage(int $currentPage): self
    {
        $obj = clone $this;
        $obj['currentPage'] = $currentPage;

        return $obj;
    }

    public function withHasNext(bool $hasNext): self
    {
        $obj = clone $this;
        $obj['hasNext'] = $hasNext;

        return $obj;
    }

    public function withTotalPages(int $totalPages): self
    {
        $obj = clone $this;
        $obj['totalPages'] = $totalPages;

        return $obj;
    }
}
