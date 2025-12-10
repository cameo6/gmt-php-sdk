<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Accounts\AccountGetResponse;
use Gmt\Accounts\AccountListCountriesParams;
use Gmt\Accounts\AccountListCountriesResponse;
use Gmt\Accounts\AccountListParams;
use Gmt\Accounts\AccountListResponse;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\PageNumber;
use Gmt\RequestOptions;

interface AccountsRawContract
{
    /**
     * @api
     *
     * @param string $countryCode ISO 3166-1 alpha-2 country code (e.g., US, RU, GB).
     *
     * @return BaseResponse<AccountGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $countryCode,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|AccountListParams $params
     *
     * @return BaseResponse<PageNumber<AccountListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|AccountListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|AccountListCountriesParams $params
     *
     * @return BaseResponse<PageNumber<AccountListCountriesResponse>>
     *
     * @throws APIException
     */
    public function listCountries(
        array|AccountListCountriesParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
