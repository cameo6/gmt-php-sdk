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

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface PurchasesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|PurchaseCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PurchaseNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|PurchaseCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param int $purchaseID unique purchase identifier
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PurchaseGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        int $purchaseID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|PurchaseListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PageNumber<PurchaseListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|PurchaseListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param int $purchaseID unique purchase identifier
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PurchaseRefundResponse>
     *
     * @throws APIException
     */
    public function refund(
        int $purchaseID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param int $purchaseID unique purchase identifier
     * @param array<string,mixed>|PurchaseRequestVerificationCodeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PurchaseRequestVerificationCodeResponse>
     *
     * @throws APIException
     */
    public function requestVerificationCode(
        int $purchaseID,
        array|PurchaseRequestVerificationCodeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
