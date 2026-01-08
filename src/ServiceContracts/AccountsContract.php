<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Accounts\AccountGetResponse;
use Gmt\Accounts\AccountListCountriesResponse;
use Gmt\Accounts\AccountListParams\Sort;
use Gmt\Accounts\AccountListResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\PageNumber;
use Gmt\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface AccountsContract
{
    /**
     * @api
     *
     * @param string $countryCode ISO 3166-1 alpha-2 country code (e.g., US, RU, GB).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $countryCode,
        RequestOptions|array|null $requestOptions = null
    ): AccountGetResponse;

    /**
     * @api
     *
     * @param string $countryCodes Filter by country codes. Comma-separated list of ISO 3166-1 alpha-2 codes (e.g., 'US,RU,GB').
     * @param int $page page number
     * @param int $pageSize number of items per page
     * @param Sort|value-of<Sort> $sort sort order for accounts
     * @param RequestOpts|null $requestOptions
     *
     * @return PageNumber<AccountListResponse>
     *
     * @throws APIException
     */
    public function list(
        ?string $countryCodes = null,
        int $page = 1,
        int $pageSize = 50,
        Sort|string $sort = 'name_asc',
        RequestOptions|array|null $requestOptions = null,
    ): PageNumber;

    /**
     * @api
     *
     * @param string $countryCodes Filter by country codes. Comma-separated list of ISO 3166-1 alpha-2 codes (e.g., 'US,RU,GB').
     * @param int $page page number
     * @param int $pageSize number of items per page
     * @param \Gmt\Accounts\AccountListCountriesParams\Sort|value-of<\Gmt\Accounts\AccountListCountriesParams\Sort> $sort sort order for accounts
     * @param RequestOpts|null $requestOptions
     *
     * @return PageNumber<AccountListCountriesResponse>
     *
     * @throws APIException
     */
    public function listCountries(
        ?string $countryCodes = null,
        int $page = 1,
        int $pageSize = 50,
        \Gmt\Accounts\AccountListCountriesParams\Sort|string $sort = 'name_asc',
        RequestOptions|array|null $requestOptions = null,
    ): PageNumber;
}
