<?php

declare(strict_types=1);

namespace Gmt\Accounts;

use Gmt\Accounts\AccountListParams\CountryCode;
use Gmt\Accounts\AccountListParams\Sort;
use Gmt\Core\Attributes\Api;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

/**
 * Returns paginated list of accounts with filtering and sorting options.
 *
 * @see Gmt\Services\AccountsService::list()
 *
 * @phpstan-type AccountListParamsShape = array{
 *   page: int,
 *   page_size: int,
 *   sort: Sort|value-of<Sort>,
 *   country_code?: string|list<string>,
 * }
 */
final class AccountListParams implements BaseModel
{
    /** @use SdkModel<AccountListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Page number (starts from 1).
     */
    #[Api]
    public int $page;

    /**
     * Number of items per page (max 50).
     */
    #[Api]
    public int $page_size;

    /**
     * Sort order for accounts.
     *
     * @var value-of<Sort> $sort
     */
    #[Api(enum: Sort::class)]
    public string $sort;

    /**
     * Filter by country codes (comma-separated, e.g., 'US,RU,GB').
     *
     * @var string|list<string>|null $country_code
     */
    #[Api(union: CountryCode::class, optional: true)]
    public string|array|null $country_code;

    /**
     * `new AccountListParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountListParams::with(page: ..., page_size: ..., sort: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountListParams)->withPage(...)->withPageSize(...)->withSort(...)
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
     * @param string|list<string> $country_code
     */
    public static function with(
        int $page = 1,
        int $page_size = 50,
        Sort|string $sort = 'name_asc',
        string|array|null $country_code = null,
    ): self {
        $obj = new self;

        $obj->page = $page;
        $obj->page_size = $page_size;
        $obj['sort'] = $sort;

        null !== $country_code && $obj->country_code = $country_code;

        return $obj;
    }

    /**
     * Page number (starts from 1).
     */
    public function withPage(int $page): self
    {
        $obj = clone $this;
        $obj->page = $page;

        return $obj;
    }

    /**
     * Number of items per page (max 50).
     */
    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj->page_size = $pageSize;

        return $obj;
    }

    /**
     * Sort order for accounts.
     *
     * @param Sort|value-of<Sort> $sort
     */
    public function withSort(Sort|string $sort): self
    {
        $obj = clone $this;
        $obj['sort'] = $sort;

        return $obj;
    }

    /**
     * Filter by country codes (comma-separated, e.g., 'US,RU,GB').
     *
     * @param string|list<string> $countryCode
     */
    public function withCountryCode(string|array $countryCode): self
    {
        $obj = clone $this;
        $obj->country_code = $countryCode;

        return $obj;
    }
}
