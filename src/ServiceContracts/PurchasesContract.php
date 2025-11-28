<?php

declare(strict_types=1);

namespace GmtPhpSDK\ServiceContracts;

use GmtPhpSDK\Core\Exceptions\APIException;
use GmtPhpSDK\PageNumber;
use GmtPhpSDK\Purchases\PurchaseCreateParams;
use GmtPhpSDK\Purchases\PurchaseGetResponse;
use GmtPhpSDK\Purchases\PurchaseListParams;
use GmtPhpSDK\Purchases\PurchaseListResponse;
use GmtPhpSDK\Purchases\PurchaseNewResponse;
use GmtPhpSDK\Purchases\PurchaseRequestVerificationCodeResponse;
use GmtPhpSDK\RequestOptions;

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
        ?RequestOptions $requestOptions = null,
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
    public function requestVerificationCode(
        int $purchaseID,
        ?RequestOptions $requestOptions = null
    ): PurchaseRequestVerificationCodeResponse;
}
