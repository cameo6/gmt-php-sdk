<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\PurchasesByHash\PurchasesByHashGetResponse;
use Gmt\PurchasesByHash\PurchasesByHashRequestVerificationCodeParams;
use Gmt\PurchasesByHash\PurchasesByHashRequestVerificationCodeResponse;
use Gmt\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface PurchasesByHashRawContract
{
    /**
     * @api
     *
     * @param string $hash Unique hash code of the purchase
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PurchasesByHashGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $hash,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $hash Unique hash code of the purchase
     * @param array<string,mixed>|PurchasesByHashRequestVerificationCodeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PurchasesByHashRequestVerificationCodeResponse>
     *
     * @throws APIException
     */
    public function requestVerificationCode(
        string $hash,
        array|PurchasesByHashRequestVerificationCodeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
