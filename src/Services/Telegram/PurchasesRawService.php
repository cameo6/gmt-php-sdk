<?php

declare(strict_types=1);

namespace Gmt\Services\Telegram;

use Gmt\Client;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\Core\Util;
use Gmt\PageNumber;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\Telegram\PurchasesRawContract;
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
final class PurchasesRawService implements PurchasesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a new purchase for Telegram premium subscription. Deducts balance immediately and returns purchase details.
     *
     * @param array{
     *   mounts: float, username: string
     * }|PurchaseCreatePremiumParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PurchaseNewPremiumResponse>
     *
     * @throws APIException
     */
    public function createPremium(
        array|PurchaseCreatePremiumParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PurchaseCreatePremiumParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/telegram/purchases/premium',
            body: (object) $parsed,
            options: $options,
            convert: PurchaseNewPremiumResponse::class,
        );
    }

    /**
     * @api
     *
     * Creates a new purchase for Telegram stars. Deducts balance immediately and returns purchase details.
     *
     * @param array{amount: float, username: string}|PurchaseCreateStarsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PurchaseNewStarsResponse>
     *
     * @throws APIException
     */
    public function createStars(
        array|PurchaseCreateStarsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PurchaseCreateStarsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/telegram/purchases/stars',
            body: (object) $parsed,
            options: $options,
            convert: PurchaseNewStarsResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns paginated history of Telegram premium subscription purchases for the authenticated user.
     *
     * @param array{page: int, pageSize: int}|PurchaseListPremiumParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PageNumber<PurchaseListPremiumResponse>>
     *
     * @throws APIException
     */
    public function listPremium(
        array|PurchaseListPremiumParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PurchaseListPremiumParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/telegram/purchases/premium',
            query: Util::array_transform_keys($parsed, ['pageSize' => 'page_size']),
            options: $options,
            convert: PurchaseListPremiumResponse::class,
            page: PageNumber::class,
        );
    }

    /**
     * @api
     *
     * Returns paginated history of star purchases for the authenticated user.
     *
     * @param array{page: int, pageSize: int}|PurchaseListStarsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PageNumber<PurchaseListStarsResponse>>
     *
     * @throws APIException
     */
    public function listStars(
        array|PurchaseListStarsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PurchaseListStarsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/telegram/purchases/stars',
            query: Util::array_transform_keys($parsed, ['pageSize' => 'page_size']),
            options: $options,
            convert: PurchaseListStarsResponse::class,
            page: PageNumber::class,
        );
    }
}
