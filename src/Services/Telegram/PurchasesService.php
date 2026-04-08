<?php

declare(strict_types=1);

namespace Gmt\Services\Telegram;

use Gmt\Client;
use Gmt\Core\Exceptions\APIException;
use Gmt\Core\Util;
use Gmt\PageNumber;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\Telegram\PurchasesContract;
use Gmt\Telegram\Purchases\PurchaseListPremiumResponse;
use Gmt\Telegram\Purchases\PurchaseListStarsResponse;
use Gmt\Telegram\Purchases\PurchaseNewPremiumResponse;
use Gmt\Telegram\Purchases\PurchaseNewStarsResponse;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class PurchasesService implements PurchasesContract
{
    /**
     * @api
     */
    public PurchasesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PurchasesRawService($client);
    }

    /**
     * @api
     *
     * Creates a new purchase for Telegram premium subscription. Deducts balance immediately and returns purchase details.
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
    ): PurchaseNewPremiumResponse {
        $params = Util::removeNulls(['mounts' => $mounts, 'username' => $username]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createPremium(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Creates a new purchase for Telegram stars. Deducts balance immediately and returns purchase details.
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
    ): PurchaseNewStarsResponse {
        $params = Util::removeNulls(['amount' => $amount, 'username' => $username]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createStars(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns paginated history of Telegram premium subscription purchases for the authenticated user.
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
    ): PageNumber {
        $params = Util::removeNulls(['page' => $page, 'pageSize' => $pageSize]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listPremium(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns paginated history of star purchases for the authenticated user.
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
    ): PageNumber {
        $params = Util::removeNulls(['page' => $page, 'pageSize' => $pageSize]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listStars(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
