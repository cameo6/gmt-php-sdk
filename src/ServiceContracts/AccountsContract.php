<?php

declare(strict_types=1);

namespace GmtPhpSDK\ServiceContracts;

use GmtPhpSDK\Accounts\AccountGetResponse;
use GmtPhpSDK\Accounts\AccountListCountriesParams;
use GmtPhpSDK\Accounts\AccountListCountriesResponse;
use GmtPhpSDK\Accounts\AccountListParams;
use GmtPhpSDK\Accounts\AccountListResponse;
use GmtPhpSDK\Core\Exceptions\APIException;
use GmtPhpSDK\PageNumber;
use GmtPhpSDK\RequestOptions;

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
