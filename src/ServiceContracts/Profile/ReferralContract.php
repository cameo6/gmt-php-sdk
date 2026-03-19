<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts\Profile;

use Gmt\Core\Exceptions\APIException;
use Gmt\Profile\Referral\ReferralGetResponse;
use Gmt\Profile\Referral\ReferralTransferBalanceResponse;
use Gmt\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface ReferralContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): ReferralGetResponse;

    /**
     * @api
     *
     * @param float $amount Amount to transfer from referral balance
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function transferBalance(
        float $amount,
        RequestOptions|array|null $requestOptions = null
    ): ReferralTransferBalanceResponse;
}
