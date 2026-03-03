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
 * Browse and purchase Telegram accounts.
 *
 * **Endpoints overview:**
 * - `GET /accounts/countries` — Public catalog with base prices (no auth required)
 * - `GET /accounts` — Personalized list with user's discounted prices (auth required)
 * - `GET /accounts/:country_code` — Detailed pricing breakdown with discount info (auth required)
 *
 * **Pricing model.** Base prices are set per country. Authenticated users may receive a personal discount based on their purchase history (discount level). Use `/accounts/:country_code` to see the full price breakdown.
 *
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
     * @param int $page page number
     * @param int $pageSize number of items per page
     * @param Sort|value-of<Sort> $sort sort order for accounts
     * @param string $countryCodes Filter by country codes. Comma-separated list of ISO 3166-1 alpha-2 codes (e.g., 'US,RU,GB').
     * @param RequestOpts|null $requestOptions
     *
     * @return PageNumber<AccountListResponse>
     *
     * @throws APIException
     */
    public function list(
        int $page = 1,
        int $pageSize = 50,
        Sort|string $sort = 'name_asc',
        ?string $countryCodes = null,
        RequestOptions|array|null $requestOptions = null,
    ): PageNumber {
        $params = Util::removeNulls(
            [
                'page' => $page,
                'pageSize' => $pageSize,
                'sort' => $sort,
                'countryCodes' => $countryCodes,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param int $page page number
     * @param int $pageSize number of items per page
     * @param \Gmt\Accounts\AccountListCountriesParams\Sort|value-of<\Gmt\Accounts\AccountListCountriesParams\Sort> $sort sort order for accounts
     * @param string $countryCodes Filter by country codes. Comma-separated list of ISO 3166-1 alpha-2 codes (e.g., 'US,RU,GB').
     * @param RequestOpts|null $requestOptions
     *
     * @return PageNumber<AccountListCountriesResponse>
     *
     * @throws APIException
     */
    public function listCountries(
        int $page = 1,
        int $pageSize = 50,
        \Gmt\Accounts\AccountListCountriesParams\Sort|string $sort = 'name_asc',
        ?string $countryCodes = null,
        RequestOptions|array|null $requestOptions = null,
    ): PageNumber {
        $params = Util::removeNulls(
            [
                'page' => $page,
                'pageSize' => $pageSize,
                'sort' => $sort,
                'countryCodes' => $countryCodes,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listCountries(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
