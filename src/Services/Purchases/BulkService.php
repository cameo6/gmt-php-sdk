<?php

declare(strict_types=1);

namespace Gmt\Services\Purchases;

use Gmt\Client;
use Gmt\Core\Exceptions\APIException;
use Gmt\Core\Util;
use Gmt\Purchases\Bulk\BulkGetResponse;
use Gmt\Purchases\Bulk\BulkNewResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\Purchases\BulkContract;

/**
 * Purchase history and management.
 *
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class BulkService implements BulkContract
{
    /**
     * @api
     */
    public BulkRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BulkRawService($client);
    }

    /**
     * @api
     *
     * Creates a new wholesale purchase for the specified country. Immediately debits the balance and returns the purchase with the status “PENDING”.
     *
     * **Wholesale purchase creation process**
     * 1. Checks the availability of the country and the user's balance.
     * 2. Reserves multiple accounts with the provider.
     * 3. Atomically debits the balance and creates a bulk purchase record.
     * 4. Returns the bulk purchase with the status “PENDING”.
     *
     * **Webhook notification.** Optionally provide `callback_url` to receive a webhook when the archive is ready.
     *
     * **Next steps.** Call “GET /bulk/:purchaseId” to get the account archive link.
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
    ): BulkNewResponse {
        $params = Util::removeNulls(
            [
                'countryCode' => $countryCode,
                'quantity' => $quantity,
                'callbackURL' => $callbackURL,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns the status of a bulk purchase, including details and link to download archive.
     *
     * @param int $purchaseID unique purchase identifier
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        int $purchaseID,
        RequestOptions|array|null $requestOptions = null
    ): BulkGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($purchaseID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Download the archive file containing multiple accounts from a successful bulk purchase
     *
     * @param int $purchaseID unique purchase identifier
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function download(
        int $purchaseID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->download($purchaseID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
