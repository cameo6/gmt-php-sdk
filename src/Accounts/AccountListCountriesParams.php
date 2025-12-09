<?php

declare(strict_types=1);

namespace Gmt\Accounts;

use Gmt\Accounts\AccountListCountriesParams\Sort;
use Gmt\Core\Attributes\Optional;
use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

/**
 * Returns a list of all available countries from providers with prices and availability. No authentication required.
 *
 * @see Gmt\Services\AccountsService::listCountries()
 *
 * @phpstan-type AccountListCountriesParamsShape = array{
 *   page: int, page_size: int, sort: Sort|value-of<Sort>, country_codes?: string
 * }
 */
final class AccountListCountriesParams implements BaseModel
{
    /** @use SdkModel<AccountListCountriesParamsShape> */
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
    public int $page_size;

    /**
     * Sort order for accounts.
     *
     * @var value-of<Sort> $sort
     */
    #[Required(enum: Sort::class)]
    public string $sort;

    /**
     * Filter by country codes. Comma-separated list of ISO 3166-1 alpha-2 codes (e.g., 'US,RU,GB').
     */
    #[Optional]
    public ?string $country_codes;

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
     */
    public static function with(
        int $page = 1,
        int $page_size = 50,
        Sort|string $sort = 'name_asc',
        ?string $country_codes = null,
    ): self {
        $obj = new self;

        $obj['page'] = $page;
        $obj['page_size'] = $page_size;
        $obj['sort'] = $sort;

        null !== $country_codes && $obj['country_codes'] = $country_codes;

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
     * Filter by country codes. Comma-separated list of ISO 3166-1 alpha-2 codes (e.g., 'US,RU,GB').
     */
    public function withCountryCodes(string $countryCodes): self
    {
        $obj = clone $this;
        $obj['country_codes'] = $countryCodes;

        return $obj;
    }
}
