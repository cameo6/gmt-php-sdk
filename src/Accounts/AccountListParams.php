<?php

declare(strict_types=1);

namespace Gmt\Accounts;

use Gmt\Accounts\AccountListParams\Sort;
use Gmt\Core\Attributes\Optional;
use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

/**
 * Returns paginated list of available accounts with **user-specific pricing** (personal discount applied).
 *
 * **Pricing.** Prices reflect the authenticated user's discount level. To see base prices without discount, use `GET /accounts/countries`.
 *
 * **Difference from `/accounts/countries`:**
 * - Requires authentication
 * - Prices include user's personal discount
 *
 * **Filtering.** Use `country_codes` to request specific countries (e.g., `US,RU,GB`).
 *
 * **Sorting options:** `price_asc`, `price_desc`, `name_asc`, `name_desc`, `popularity_asc`, `popularity_desc`.
 *
 * @see Gmt\Services\AccountsService::list()
 *
 * @phpstan-type AccountListParamsShape = array{
 *   page: int,
 *   pageSize: int,
 *   sort: Sort|value-of<Sort>,
 *   countryCodes?: string|null,
 * }
 */
final class AccountListParams implements BaseModel
{
    /** @use SdkModel<AccountListParamsShape> */
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
     * `new AccountListParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountListParams::with(page: ..., pageSize: ..., sort: ...)
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
