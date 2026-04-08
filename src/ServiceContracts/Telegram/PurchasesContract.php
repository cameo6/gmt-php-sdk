<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts\Telegram;

use Gmt\Core\Exceptions\APIException;
use Gmt\PageNumber;
use Gmt\RequestOptions;
use Gmt\Telegram\Purchases\PurchaseListPremiumResponse;
use Gmt\Telegram\Purchases\PurchaseListStarsResponse;
use Gmt\Telegram\Purchases\PurchaseNewPremiumResponse;
use Gmt\Telegram\Purchases\PurchaseNewStarsResponse;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface PurchasesContract
{
    /**
     * @api
     *
     * @param float $mounts The number of months for the premium subscription (3, 6, or 12)
     * @param string $username Recipient Telegram username (@optional, 5-32 chars)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createPremium(
        float $mounts,
        string $username,
        RequestOptions|array|null $requestOptions = null,
    ): PurchaseNewPremiumResponse;

    /**
     * @api
     *
     * @param float $amount The amount of stars to purchase (50-10000)
     * @param string $username Recipient Telegram username (@optional, 5-32 chars)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createStars(
        float $amount,
        string $username,
        RequestOptions|array|null $requestOptions = null,
    ): PurchaseNewStarsResponse;

    /**
     * @api
     *
     * @param int $page page number
     * @param int $pageSize number of items per page
     * @param RequestOpts|null $requestOptions
     *
     * @return PageNumber<PurchaseListPremiumResponse>
     *
     * @throws APIException
     */
    public function listPremium(
        int $page = 1,
        int $pageSize = 50,
        RequestOptions|array|null $requestOptions = null,
    ): PageNumber;

    /**
     * @api
     *
     * @param int $page page number
     * @param int $pageSize number of items per page
     * @param RequestOpts|null $requestOptions
     *
     * @return PageNumber<PurchaseListStarsResponse>
     *
     * @throws APIException
     */
    public function listStars(
        int $page = 1,
        int $pageSize = 50,
        RequestOptions|array|null $requestOptions = null,
    ): PageNumber;
}
