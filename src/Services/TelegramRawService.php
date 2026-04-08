<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\TelegramRawContract;
use Gmt\Telegram\TelegramGetPremiumPriceParams;
use Gmt\Telegram\TelegramGetPremiumPriceResponse;
use Gmt\Telegram\TelegramGetStarsPriceParams;
use Gmt\Telegram\TelegramGetStarsPriceResponse;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class TelegramRawService implements TelegramRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns the current price of Telegram premium subscription in USD.
     *
     * @param array{mounts: string}|TelegramGetPremiumPriceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TelegramGetPremiumPriceResponse>
     *
     * @throws APIException
     */
    public function getPremiumPrice(
        array|TelegramGetPremiumPriceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TelegramGetPremiumPriceParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/telegram/premium',
            query: $parsed,
            options: $options,
            convert: TelegramGetPremiumPriceResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns the current price of stars in USD.
     *
     * @param array{amount: string}|TelegramGetStarsPriceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TelegramGetStarsPriceResponse>
     *
     * @throws APIException
     */
    public function getStarsPrice(
        array|TelegramGetStarsPriceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TelegramGetStarsPriceParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/telegram/stars',
            query: $parsed,
            options: $options,
            convert: TelegramGetStarsPriceResponse::class,
        );
    }
}
