<?php

declare(strict_types=1);

namespace Gmt\Services\Profile;

use Gmt\Client;
use Gmt\Core\Exceptions\APIException;
use Gmt\Core\Util;
use Gmt\Profile\Referral\ReferralGetResponse;
use Gmt\Profile\Referral\ReferralTransferBalanceResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\Profile\ReferralContract;

/**
 * User profile management.
 *
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class ReferralService implements ReferralContract
{
    /**
     * @api
     */
    public ReferralRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ReferralRawService($client);
    }

    /**
     * @api
     *
     * Returns user's referral program status, including current level, commission percentage, referral count, and earnings.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): ReferralGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Change the current user password to a new one.
     *
     * @param float $amount Amount to transfer from referral balance
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function transferBalance(
        float $amount,
        RequestOptions|array|null $requestOptions = null
    ): ReferralTransferBalanceResponse {
        $params = Util::removeNulls(['amount' => $amount]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->transferBalance(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
