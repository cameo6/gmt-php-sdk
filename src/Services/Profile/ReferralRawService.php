<?php

declare(strict_types=1);

namespace Gmt\Services\Profile;

use Gmt\Client;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\Profile\Referral\ReferralGetResponse;
use Gmt\Profile\Referral\ReferralTransferBalanceParams;
use Gmt\Profile\Referral\ReferralTransferBalanceResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\Profile\ReferralRawContract;

/**
 * User profile management.
 *
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class ReferralRawService implements ReferralRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns user's referral program status, including current level, commission percentage, referral count, and earnings.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ReferralGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/profile/referral',
            options: $requestOptions,
            convert: ReferralGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Transfers a specified amount from the user's referral balance to their main balance. The amount must be between 1 and 100,000 USD.
     *
     * @param array{amount: float}|ReferralTransferBalanceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ReferralTransferBalanceResponse>
     *
     * @throws APIException
     */
    public function transferBalance(
        array|ReferralTransferBalanceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ReferralTransferBalanceParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/profile/referral/transfer-balance',
            body: (object) $parsed,
            options: $options,
            convert: ReferralTransferBalanceResponse::class,
        );
    }
}
