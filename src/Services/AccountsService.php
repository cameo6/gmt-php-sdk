<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Accounts\AccountGetResponse;
use Gmt\Accounts\AccountListCountriesParams;
use Gmt\Accounts\AccountListCountriesResponse;
use Gmt\Accounts\AccountListParams;
use Gmt\Accounts\AccountListResponse;
use Gmt\Client;
use Gmt\Core\Exceptions\APIException;
use Gmt\PageNumber;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\AccountsContract;

final class AccountsService implements AccountsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns detailed information about account for specific country including pricing and discount information.
     *
     * @throws APIException
     */
    public function retrieve(
        string $countryCode,
        ?RequestOptions $requestOptions = null
    ): AccountGetResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/accounts/%1$s', $countryCode],
            options: $requestOptions,
            convert: AccountGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns paginated list of accounts with filtering and sorting options.
     *
     * @param array{
     *   page?: int,
     *   page_size?: int,
     *   sort?: 'price_asc'|'price_desc'|'name_asc'|'name_desc',
     *   country_code?: string,
     * }|AccountListParams $params
     *
     * @return PageNumber<AccountListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|AccountListParams $params,
        ?RequestOptions $requestOptions = null
    ): PageNumber {
        [$parsed, $options] = AccountListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/accounts/',
            query: $parsed,
            options: $options,
            convert: AccountListResponse::class,
            page: PageNumber::class,
        );
    }

    /**
     * @api
     *
     * Returns a list of all available countries from providers with prices and availability. No authentication required.
     *
     * @param array{
     *   page?: int,
     *   page_size?: int,
     *   sort?: 'price_asc'|'price_desc'|'name_asc'|'name_desc',
     *   country_code?: string,
     * }|AccountListCountriesParams $params
     *
     * @return PageNumber<AccountListCountriesResponse>
     *
     * @throws APIException
     */
    public function listCountries(
        array|AccountListCountriesParams $params,
        ?RequestOptions $requestOptions = null,
    ): PageNumber {
        [$parsed, $options] = AccountListCountriesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/accounts/countries',
            query: $parsed,
            options: $options,
            convert: AccountListCountriesResponse::class,
            page: PageNumber::class,
        );
    }
}
