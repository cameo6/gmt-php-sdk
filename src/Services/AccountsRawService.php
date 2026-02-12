<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Accounts\AccountGetResponse;
use Gmt\Accounts\AccountListCountriesParams;
use Gmt\Accounts\AccountListCountriesResponse;
use Gmt\Accounts\AccountListParams;
use Gmt\Accounts\AccountListParams\Sort;
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
     * Returns detailed pricing breakdown for a specific country, showing how the user's discount is applied.
     *
     * **Response includes:**
     * - `price` — final price after user's personal discount
     * - `discount.base_price` — price before discount
     * - `discount.percent` — discount percentage applied
     *
     * **Use case.** Account detail/checkout page where user needs to see both the original price and their discounted price.
     *
     * **Example.** If base price is $3.00 and user has 10% discount:
     * - `price.amount`: `"2.70"`
     * - `discount.base_price`: `"3.00"`
     * - `discount.percent`: `10`
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
     * @param array{
     *   page: int, pageSize: int, sort: value-of<Sort>, countryCodes?: string
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
     * Returns paginated list of all available countries with **base pricing** (no user discount applied). No authentication required.
     *
     * **Use case.** Public catalog for the website landing page. Shows general pricing and stock availability.
     *
     * **Pricing.** Prices are base prices before any user discount. For personalized pricing, use `GET /accounts` (requires authentication).
     *
     * **Filtering.** Use `country_codes` to request specific countries (e.g., `US,RU,GB`).
     *
     * **Sorting options:** `price_asc`, `price_desc`, `name_asc`, `name_desc`, `popularity_asc`, `popularity_desc`.
     *
     * @param array{
     *   page: int,
     *   pageSize: int,
     *   sort: value-of<AccountListCountriesParams\Sort>,
     *   countryCodes?: string,
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
