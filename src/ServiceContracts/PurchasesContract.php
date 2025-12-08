<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

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

interface PurchasesContract
{
    /**
     * @api
     *
     * @param array<mixed>|PurchaseCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|PurchaseCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): PurchaseNewResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        int $purchaseID,
        ?RequestOptions $requestOptions = null
    ): PurchaseGetResponse;

    /**
     * @api
     *
     * @param array<mixed>|PurchaseListParams $params
     *
     * @return PageNumber<PurchaseListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|PurchaseListParams $params,
        ?RequestOptions $requestOptions = null
    ): PageNumber;

    /**
     * @api
     *
     * @throws APIException
     */
    public function refund(
        int $purchaseID,
        ?RequestOptions $requestOptions = null
    ): PurchaseRefundResponse;

    /**
     * @api
     *
     * @param array<mixed>|PurchaseRequestVerificationCodeParams $params
     *
     * @throws APIException
     */
    public function requestVerificationCode(
        int $purchaseID,
        array|PurchaseRequestVerificationCodeParams $params,
        ?RequestOptions $requestOptions = null,
    ): PurchaseRequestVerificationCodeResponse;
}
