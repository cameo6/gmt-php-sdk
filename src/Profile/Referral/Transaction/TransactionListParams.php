<?php

declare(strict_types=1);

namespace Gmt\Profile\Referral\Transaction;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

/**
 * Returns paginated referral transaction history for the authenticated user, ordered by newest first.
 *
 * @see Gmt\Services\Profile\Referral\TransactionService::list()
 *
 * @phpstan-type TransactionListParamsShape = array{page: int, pageSize: int}
 */
final class TransactionListParams implements BaseModel
{
    /** @use SdkModel<TransactionListParamsShape> */
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
     * `new TransactionListParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TransactionListParams::with(page: ..., pageSize: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TransactionListParams)->withPage(...)->withPageSize(...)
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
    public static function with(int $page = 1, int $pageSize = 50): self
    {
        $self = new self;

        $self['page'] = $page;
        $self['pageSize'] = $pageSize;

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
}
