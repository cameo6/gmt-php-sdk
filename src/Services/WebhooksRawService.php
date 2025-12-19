<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\WebhooksRawContract;
use Gmt\Webhooks\WebhookTestParams;
use Gmt\Webhooks\WebhookTestParams\Type;
use Gmt\Webhooks\WebhookTestResponse;

final class WebhooksRawService implements WebhooksRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Sends a test webhook to the specified URL and returns the result.
     *
     * **Use case.** Verify your webhook endpoint is correctly configured before using it in production.
     *
     * **Payload types:**
     * - `success` - simulates successful code retrieval with verification data
     * - `failed` - simulates failed code retrieval with error message
     *
     * **Your endpoint must return HTTP 200** to indicate successful receipt.
     *
     * **Testing tool.** Use https://webhook.site to get a temporary URL for testing.
     *
     * **No persistence.** Test webhooks are not stored in delivery history.
     *
     * @param array{
     *   url: string, type?: 'success'|'failed'|Type
     * }|WebhookTestParams $params
     *
     * @return BaseResponse<WebhookTestResponse>
     *
     * @throws APIException
     */
    public function test(
        array|WebhookTestParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = WebhookTestParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/webhooks/test',
            body: (object) $parsed,
            options: $options,
            convert: WebhookTestResponse::class,
        );
    }
}
