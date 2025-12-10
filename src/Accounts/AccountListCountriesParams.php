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
 *   page: int, pageSize: int, sort: Sort|value-of<Sort>, countryCodes?: string
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
    public int $pageSize;

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
    public ?string $countryCodes;

    /**
     * `new AccountListCountriesParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountListCountriesParams::with(page: ..., pageSize: ..., sort: ...)
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
        int $pageSize = 50,
        Sort|string $sort = 'name_asc',
        ?string $countryCodes = null,
    ): self {
        $self = new self;

        $self['page'] = $page;
        $self['pageSize'] = $pageSize;
        $self['sort'] = $sort;

        null !== $countryCodes && $self['countryCodes'] = $countryCodes;

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
     * Sort order for accounts.
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
     * Filter by country codes. Comma-separated list of ISO 3166-1 alpha-2 codes (e.g., 'US,RU,GB').
     */
    public function withCountryCodes(string $countryCodes): self
    {
        $self = clone $this;
        $self['countryCodes'] = $countryCodes;

        return $self;
    }
}
