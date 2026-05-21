<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\PurchasesByHash\PurchasesByHashGetResponse;
use Gmt\PurchasesByHash\PurchasesByHashRequestVerificationCodeParams;
use Gmt\PurchasesByHash\PurchasesByHashRequestVerificationCodeResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\PurchasesByHashRawContract;

/**
 * Endpoints for accessing purchase details and requesting verification codes using a unique hash identifier instead of purchase ID. This allows retrieval of purchase information without authentication, using the hash as a secure access token.
 *
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class PurchasesByHashRawService implements PurchasesByHashRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

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
     * @return BaseResponse<PurchasesByHashGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $hash,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/purchases-by-hash/%1$s', $hash],
            options: $requestOptions,
            convert: PurchasesByHashGetResponse::class,
        );
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
     * @param array{
     *   callbackURL?: string
     * }|PurchasesByHashRequestVerificationCodeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PurchasesByHashRequestVerificationCodeResponse>
     *
     * @throws APIException
     */
    public function requestVerificationCode(
        string $hash,
        array|PurchasesByHashRequestVerificationCodeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PurchasesByHashRequestVerificationCodeParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/purchases-by-hash/%1$s/request-code', $hash],
            body: (object) $parsed,
            options: $options,
            convert: PurchasesByHashRequestVerificationCodeResponse::class,
        );
    }
}
