<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\PageNumber;
use Gmt\Purchases\PurchaseCreateParams;
use Gmt\Purchases\PurchaseGetResponse;
use Gmt\Purchases\PurchaseListParams;
use Gmt\Purchases\PurchaseListResponse;
use Gmt\Purchases\PurchaseNewResponse;
use Gmt\Purchases\PurchaseRefundResponse;
use Gmt\Purchases\PurchaseRequestVerificationCodeParams;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse;
use Gmt\RequestOptions;

interface PurchasesRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|PurchaseCreateParams $params
     *
     * @return BaseResponse<PurchaseNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|PurchaseCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param int $purchaseID unique purchase identifier
     *
     * @return BaseResponse<PurchaseGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        int $purchaseID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<mixed>|PurchaseListParams $params
     *
     * @return BaseResponse<PageNumber<PurchaseListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|PurchaseListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param int $purchaseID unique purchase identifier
     *
     * @return BaseResponse<PurchaseRefundResponse>
     *
     * @throws APIException
     */
    public function refund(
        int $purchaseID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param int $purchaseID unique purchase identifier
     * @param array<mixed>|PurchaseRequestVerificationCodeParams $params
     *
     * @return BaseResponse<PurchaseRequestVerificationCodeResponse>
     *
     * @throws APIException
     */
    public function requestVerificationCode(
        int $purchaseID,
        array|PurchaseRequestVerificationCodeParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
