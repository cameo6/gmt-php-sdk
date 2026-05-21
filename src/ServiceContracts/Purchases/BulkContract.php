<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts\Purchases;

use Gmt\Core\Exceptions\APIException;
use Gmt\Purchases\Bulk\BulkGetResponse;
use Gmt\Purchases\Bulk\BulkNewResponse;
use Gmt\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface BulkContract
{
    /**
     * @api
     *
     * @param string $countryCode ISO 3166-1 alpha-2 country code
     * @param int $quantity Number of accounts to purchase
     * @param string $callbackURL URL to receive webhook notification when bulk archive is ready. POST request will be sent with `WebhookBulkReadyPayload`.
     *
     * **Retry policy.** If your endpoint does not return HTTP 200, webhook will be retried up to 3 times with delays: immediately, after 10 seconds, after 30 seconds. Any non-200 response triggers retry.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $countryCode,
        int $quantity,
        ?string $callbackURL = null,
        RequestOptions|array|null $requestOptions = null,
    ): BulkNewResponse;

    /**
     * @api
     *
     * @param int $purchaseID unique purchase identifier
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        int $purchaseID,
        RequestOptions|array|null $requestOptions = null
    ): BulkGetResponse;

    /**
     * @api
     *
     * @param int $purchaseID unique purchase identifier
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function download(
        int $purchaseID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
