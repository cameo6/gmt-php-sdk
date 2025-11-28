<?php

declare(strict_types=1);

namespace Gmt\Accounts;

use Gmt\Accounts\AccountListCountriesParams\CountryCode;
use Gmt\Accounts\AccountListCountriesParams\Sort;
use Gmt\Core\Attributes\Api;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

/**
 * Returns a list of all available countries from providers with prices and availability. No authentication required.
 *
 * @see Gmt\Services\AccountsService::listCountries()
 *
 * @phpstan-type AccountListCountriesParamsShape = array{
 *   page: int,
 *   page_size: int,
 *   sort: Sort|value-of<Sort>,
 *   country_code?: string|list<string>,
 * }
 */
final class AccountListCountriesParams implements BaseModel
{
    /** @use SdkModel<AccountListCountriesParamsShape> */
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
     * `new AccountListCountriesParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountListCountriesParams::with(page: ..., page_size: ..., sort: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountListCountriesParams)
     *   ->withPage(...)
     *   ->withPageSize(...)
     *   ->withSort(...)
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
