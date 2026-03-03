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

/**
 * Webhook testing and documentation.
 *
 * ## Webhook Payload Types
 *
 * When you provide `callback_url` in `POST /purchases/:id/request-code`, your endpoint will receive one of the following payloads:
 *
 * - **WebhookSuccessPayload** — sent when verification code is successfully retrieved
 * - **WebhookFailedPayload** — sent when code retrieval fails after all retry attempts
 *
 * When you provide `callback_url` in `POST /purchases/bulk`, your endpoint will receive:
 *
 * - **WebhookBulkReadyPayload** — sent when bulk archive is ready
 *
 * See the **Models** section below for detailed payload structure.
 *
 * ## Requirements
 *
 * - Your endpoint **must return HTTP 200** to acknowledge receipt
 * - Response timeout: **5 seconds**
 * - Failed deliveries are retried up to **3 times** (immediately, after 10s, after 30s)
 *
 * ## Testing
 *
 * Use `POST /v1/webhooks/test` to verify your endpoint. Get a temporary test URL at https://webhook.site
 *
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
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
     * @param array{type: Type|value-of<Type>, url: string}|WebhookTestParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookTestResponse>
     *
     * @throws APIException
     */
    public function test(
        array|WebhookTestParams $params,
        RequestOptions|array|null $requestOptions = null,
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
