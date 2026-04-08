<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Exceptions\APIException;
use Gmt\RequestOptions;
use Gmt\Telegram\TelegramGetPremiumPriceResponse;
use Gmt\Telegram\TelegramGetStarsPriceResponse;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface TelegramContract
{
    /**
     * @api
     *
     * @param string $mounts The number of months for the premium subscription (3, 6, or 12)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getPremiumPrice(
        string $mounts,
        RequestOptions|array|null $requestOptions = null
    ): TelegramGetPremiumPriceResponse;

    /**
     * @api
     *
     * @param string $amount The amount of stars to purchase (50-10000)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStarsPrice(
        string $amount,
        RequestOptions|array|null $requestOptions = null
    ): TelegramGetStarsPriceResponse;
}
