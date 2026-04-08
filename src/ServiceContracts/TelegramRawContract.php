<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\RequestOptions;
use Gmt\Telegram\TelegramGetPremiumPriceParams;
use Gmt\Telegram\TelegramGetPremiumPriceResponse;
use Gmt\Telegram\TelegramGetStarsPriceParams;
use Gmt\Telegram\TelegramGetStarsPriceResponse;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface TelegramRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|TelegramGetPremiumPriceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TelegramGetPremiumPriceResponse>
     *
     * @throws APIException
     */
    public function getPremiumPrice(
        array|TelegramGetPremiumPriceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TelegramGetStarsPriceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TelegramGetStarsPriceResponse>
     *
     * @throws APIException
     */
    public function getStarsPrice(
        array|TelegramGetStarsPriceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
