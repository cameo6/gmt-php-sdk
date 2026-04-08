<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts\Telegram;

use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\PageNumber;
use Gmt\RequestOptions;
use Gmt\Telegram\Purchases\PurchaseCreatePremiumParams;
use Gmt\Telegram\Purchases\PurchaseCreateStarsParams;
use Gmt\Telegram\Purchases\PurchaseListPremiumParams;
use Gmt\Telegram\Purchases\PurchaseListPremiumResponse;
use Gmt\Telegram\Purchases\PurchaseListStarsParams;
use Gmt\Telegram\Purchases\PurchaseListStarsResponse;
use Gmt\Telegram\Purchases\PurchaseNewPremiumResponse;
use Gmt\Telegram\Purchases\PurchaseNewStarsResponse;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface PurchasesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|PurchaseCreatePremiumParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PurchaseNewPremiumResponse>
     *
     * @throws APIException
     */
    public function createPremium(
        array|PurchaseCreatePremiumParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|PurchaseCreateStarsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PurchaseNewStarsResponse>
     *
     * @throws APIException
     */
    public function createStars(
        array|PurchaseCreateStarsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|PurchaseListPremiumParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PageNumber<PurchaseListPremiumResponse>>
     *
     * @throws APIException
     */
    public function listPremium(
        array|PurchaseListPremiumParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|PurchaseListStarsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PageNumber<PurchaseListStarsResponse>>
     *
     * @throws APIException
     */
    public function listStars(
        array|PurchaseListStarsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
