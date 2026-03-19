<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts\Profile;

use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\Profile\Referral\ReferralGetResponse;
use Gmt\Profile\Referral\ReferralTransferBalanceParams;
use Gmt\Profile\Referral\ReferralTransferBalanceResponse;
use Gmt\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface ReferralRawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ReferralGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ReferralTransferBalanceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ReferralTransferBalanceResponse>
     *
     * @throws APIException
     */
    public function transferBalance(
        array|ReferralTransferBalanceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
