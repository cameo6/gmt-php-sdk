<?php

declare(strict_types=1);

namespace Gmt\Services\Purchases;

use Gmt\Client;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\Purchases\Bulk\BulkCreateParams;
use Gmt\Purchases\Bulk\BulkNewResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\Purchases\BulkRawContract;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class BulkRawService implements BulkRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

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
     * @param array{
     *   countryCode: string, quantity: int, callbackURL?: string
     * }|BulkCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BulkNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|BulkCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BulkCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/purchases/bulk',
            body: (object) $parsed,
            options: $options,
            convert: BulkNewResponse::class,
        );
    }
}
