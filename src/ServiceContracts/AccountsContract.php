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

interface AccountsContract
{
    /**
     * @api
     *
     * @param string $countryCode ISO 3166-1 alpha-2 country code (e.g., US, RU, GB).
     *
     * @throws APIException
     */
    public function retrieve(
        string $countryCode,
        ?RequestOptions $requestOptions = null
    ): AccountGetResponse;

    /**
     * @api
     *
     * @param int $page page number
     * @param int $pageSize number of items per page
     * @param 'price_asc'|'price_desc'|'name_asc'|'name_desc'|Sort $sort sort order for accounts
     * @param string $countryCodes Filter by country codes. Comma-separated list of ISO 3166-1 alpha-2 codes (e.g., 'US,RU,GB').
     *
     * @return PageNumber<AccountListResponse>
     *
     * @throws APIException
     */
    public function list(
        int $page = 1,
        int $pageSize = 50,
        string|Sort $sort = 'name_asc',
        ?string $countryCodes = null,
        ?RequestOptions $requestOptions = null,
    ): PageNumber;

    /**
     * @api
     *
     * @param int $page page number
     * @param int $pageSize number of items per page
     * @param 'price_asc'|'price_desc'|'name_asc'|'name_desc'|\Gmt\Accounts\AccountListCountriesParams\Sort $sort sort order for accounts
     * @param string $countryCodes Filter by country codes. Comma-separated list of ISO 3166-1 alpha-2 codes (e.g., 'US,RU,GB').
     *
     * @return PageNumber<AccountListCountriesResponse>
     *
     * @throws APIException
     */
    public function listCountries(
        int $page = 1,
        int $pageSize = 50,
        string|\Gmt\Accounts\AccountListCountriesParams\Sort $sort = 'name_asc',
        ?string $countryCodes = null,
        ?RequestOptions $requestOptions = null,
    ): PageNumber;
}
