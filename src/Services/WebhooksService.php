<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\Core\Exceptions\APIException;
use Gmt\Core\Util;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\WebhooksContract;
use Gmt\Webhooks\WebhookTestParams\Type;
use Gmt\Webhooks\WebhookTestResponse;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class WebhooksService implements WebhooksContract
{
    /**
     * @api
     */
    public WebhooksRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WebhooksRawService($client);
    }

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
     * @param string $url Webhook endpoint URL. Must be a valid URL.
     * @param Type|value-of<Type> $type webhook payload type to send: `success` or `failed`
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function test(
        string $url,
        Type|string $type = 'success',
        RequestOptions|array|null $requestOptions = null,
    ): WebhookTestResponse {
        $params = Util::removeNulls(['type' => $type, 'url' => $url]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->test(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
