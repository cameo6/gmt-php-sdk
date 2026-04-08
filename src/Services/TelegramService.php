<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\Core\Exceptions\APIException;
use Gmt\Core\Util;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\TelegramContract;
use Gmt\Services\Telegram\PurchasesService;
use Gmt\Telegram\TelegramGetPremiumPriceResponse;
use Gmt\Telegram\TelegramGetStarsPriceResponse;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class TelegramService implements TelegramContract
{
    /**
     * @api
     */
    public TelegramRawService $raw;

    /**
     * @api
     */
    public PurchasesService $purchases;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TelegramRawService($client);
        $this->purchases = new PurchasesService($client);
    }

    /**
     * @api
     *
     * Returns the current price of Telegram premium subscription in USD.
     *
     * @param string $mounts The number of months for the premium subscription (3, 6, or 12)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getPremiumPrice(
        string $mounts,
        RequestOptions|array|null $requestOptions = null
    ): TelegramGetPremiumPriceResponse {
        $params = Util::removeNulls(['mounts' => $mounts]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getPremiumPrice(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns the current price of stars in USD.
     *
     * @param string $amount The amount of stars to purchase (50-10000)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getStarsPrice(
        string $amount,
        RequestOptions|array|null $requestOptions = null
    ): TelegramGetStarsPriceResponse {
        $params = Util::removeNulls(['amount' => $amount]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getStarsPrice(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
