<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Exceptions\APIException;
use Gmt\PurchasesByHash\PurchasesByHashGetResponse;
use Gmt\PurchasesByHash\PurchasesByHashRequestVerificationCodeResponse;
use Gmt\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface PurchasesByHashContract
{
    /**
     * @api
     *
     * @param string $hash Unique hash code of the purchase
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $hash,
        RequestOptions|array|null $requestOptions = null
    ): PurchasesByHashGetResponse;

    /**
     * @api
     *
     * @param string $hash Unique hash code of the purchase
     * @param string $callbackURL URL to receive webhook notification when code is received. POST request will be sent with either `WebhookSuccessPayload` or `WebhookFailedPayload`.
     *
     * **Retry policy.** If your endpoint does not return HTTP 200, webhook will be retried up to 3 times with delays: immediately, after 10 seconds, after 30 seconds. Any non-200 response triggers retry.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function requestVerificationCode(
        string $hash,
        ?string $callbackURL = null,
        RequestOptions|array|null $requestOptions = null,
    ): PurchasesByHashRequestVerificationCodeResponse;
}
