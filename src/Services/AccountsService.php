<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Accounts\AccountGetResponse;
use Gmt\Accounts\AccountListCountriesResponse;
use Gmt\Accounts\AccountListParams\Sort;
use Gmt\Accounts\AccountListResponse;
use Gmt\Client;
use Gmt\Core\Exceptions\APIException;
use Gmt\Core\Util;
use Gmt\PageNumber;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\AccountsContract;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class AccountsService implements AccountsContract
{
    /**
     * @api
     */
    public AccountsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AccountsRawService($client);
    }

    /**
     * @api
     *
     * Returns detailed information about account for specific country including pricing and discount information.
     *
     * @param string $countryCode ISO 3166-1 alpha-2 country code (e.g., US, RU, GB).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $countryCode,
        RequestOptions|array|null $requestOptions = null
    ): AccountGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($countryCode, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns paginated list of accounts with filtering and sorting options.
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
    ): PageNumber {
        $params = Util::removeNulls(
            [
                'countryCodes' => $countryCodes,
                'page' => $page,
                'pageSize' => $pageSize,
                'sort' => $sort,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns a list of all available countries from providers with prices and availability. No authentication required.
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
    ): PageNumber {
        $params = Util::removeNulls(
            [
                'countryCodes' => $countryCodes,
                'page' => $page,
                'pageSize' => $pageSize,
                'sort' => $sort,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listCountries(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
