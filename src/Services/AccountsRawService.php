<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Accounts\AccountGetResponse;
use Gmt\Accounts\AccountListCountriesParams;
use Gmt\Accounts\AccountListCountriesParams\Sort;
use Gmt\Accounts\AccountListCountriesResponse;
use Gmt\Accounts\AccountListParams;
use Gmt\Accounts\AccountListResponse;
use Gmt\Client;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\Core\Util;
use Gmt\PageNumber;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\AccountsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class AccountsRawService implements AccountsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns detailed information about account for specific country including pricing and discount information.
     *
     * @param string $countryCode ISO 3166-1 alpha-2 country code (e.g., US, RU, GB).
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $countryCode,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
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
     *   page: int,
     *   pageSize: int,
     *   sort: AccountListParams\Sort|value-of<AccountListParams\Sort>,
     *   countryCodes?: string,
     * }|AccountListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PageNumber<AccountListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|AccountListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/accounts/',
            query: Util::array_transform_keys(
                $parsed,
                ['pageSize' => 'page_size', 'countryCodes' => 'country_codes']
            ),
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
     *   page: int, pageSize: int, sort: value-of<Sort>, countryCodes?: string
     * }|AccountListCountriesParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PageNumber<AccountListCountriesResponse>>
     *
     * @throws APIException
     */
    public function listCountries(
        array|AccountListCountriesParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountListCountriesParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/accounts/countries',
            query: Util::array_transform_keys(
                $parsed,
                ['pageSize' => 'page_size', 'countryCodes' => 'country_codes']
            ),
            options: $options,
            convert: AccountListCountriesResponse::class,
            page: PageNumber::class,
        );
    }
}
