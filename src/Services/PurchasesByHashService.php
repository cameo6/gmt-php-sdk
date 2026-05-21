<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\Core\Exceptions\APIException;
use Gmt\Core\Util;
use Gmt\PurchasesByHash\PurchasesByHashGetResponse;
use Gmt\PurchasesByHash\PurchasesByHashRequestVerificationCodeResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\PurchasesByHashContract;

/**
 * Endpoints for accessing purchase details and requesting verification codes using a unique hash identifier instead of purchase ID. This allows retrieval of purchase information without authentication, using the hash as a secure access token.
 *
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class PurchasesByHashService implements PurchasesByHashContract
{
    /**
     * @api
     */
    public PurchasesByHashRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PurchasesByHashRawService($client);
    }

    /**
     * @api
     *
     * Returns detailed information about specific purchase by its hash code including verification data if available.
     *
     * **No authentication required.** The hash code serves as the access token.
     *
     * **Path parameter `hash`.** If it is missing or empty in the URL (e.g. `/v1/purchases-by-hash/` or `/v1/purchases-by-hash//`), the API returns **400** with `fieldViolations` on `hash`.
     *
     * @param string $hash Unique hash code of the purchase
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $hash,
        RequestOptions|array|null $requestOptions = null
    ): PurchasesByHashGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($hash, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Requests verification code and password from provider using purchase hash code. Updates purchase status to SUCCESS.
     *
     * **No authentication required.** The hash code serves as the access token.
     *
     * **Idempotent Operation.** Safe to retry on network errors - will not generate duplicate codes.
     *
     * **Path parameter `hash`.** If it is missing or empty before `/request-code` (e.g. `/v1/purchases-by-hash/request-code`), the API returns **400** with `fieldViolations` on `hash`.
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
    ): PurchasesByHashRequestVerificationCodeResponse {
        $params = Util::removeNulls(['callbackURL' => $callbackURL]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->requestVerificationCode($hash, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
