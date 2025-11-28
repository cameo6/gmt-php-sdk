<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Accounts\AccountGetResponse;
use Gmt\Accounts\AccountListCountriesParams;
use Gmt\Accounts\AccountListCountriesResponse;
use Gmt\Accounts\AccountListParams;
use Gmt\Accounts\AccountListResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\PageNumber;
use Gmt\RequestOptions;

interface AccountsContract
{
    /**
     * @api
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
     * @param array<mixed>|AccountListParams $params
     *
     * @return PageNumber<AccountListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|AccountListParams $params,
        ?RequestOptions $requestOptions = null
    ): PageNumber;

    /**
     * @api
     *
     * @param array<mixed>|AccountListCountriesParams $params
     *
     * @return PageNumber<AccountListCountriesResponse>
     *
     * @throws APIException
     */
    public function listCountries(
        array|AccountListCountriesParams $params,
        ?RequestOptions $requestOptions = null,
    ): PageNumber;
}
