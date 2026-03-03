<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\Core\Util;
use Gmt\PageNumber;
use Gmt\Purchases\PurchaseCreateParams;
use Gmt\Purchases\PurchaseGetResponse;
use Gmt\Purchases\PurchaseListParams;
use Gmt\Purchases\PurchaseListParams\Status;
use Gmt\Purchases\PurchaseListResponse;
use Gmt\Purchases\PurchaseNewResponse;
use Gmt\Purchases\PurchaseRefundResponse;
use Gmt\Purchases\PurchaseRequestVerificationCodeParams;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\PurchasesRawContract;

/**
 * Purchase history and management.
 *
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class PurchasesRawService implements PurchasesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Creates a new purchase for specified country. Deducts balance immediately and returns purchase with `PENDING` status.
     *
     * **Purchase Creation Process**
     * 1. Validates country availability and user balance.
     * 2. Reserves account from provider.
     * 3. Atomically deducts balance and creates purchase record.
     * 4. Returns purchase in `PENDING` status.
     *
     * **Next steps.** Call `POST /purchases/:id/request-code` to retrieve login credentials.
     *
     * **Country availability.** Accounts may become unavailable between checking `/accounts` and creating purchase. Always handle availability errors gracefully.
     *
     * @param array{countryCode: string}|PurchaseCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PurchaseNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|PurchaseCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PurchaseCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'v1/purchases/',
            body: (object) $parsed,
            options: $options,
            convert: PurchaseNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns detailed information about specific purchase including verification data if available.
     *
     * **Security.** Verification data is only visible to the purchase owner.
     *
     * @param int $purchaseID unique purchase identifier
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PurchaseGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        int $purchaseID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/purchases/%1$s', $purchaseID],
            options: $requestOptions,
            convert: PurchaseGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns paginated list of user's purchases with optional status filtering.
     *
     * **Chronological Ordering.** Purchases are always returned **newest first** (descending by `created_at`).
     *
     * **Pagination behavior**
     * - Results are consistent during session (no duplicates or missing items when paginating).
     * - `has_next: true` indicates more pages available.
     * - Maximum `page_size` is 50 items.
     *
     * **Filtering.** Combine `status` filter with pagination for subset queries (e.g., all successful purchases).
     *
     * @param array{
     *   page: int, pageSize: int, status?: Status|value-of<Status>
     * }|PurchaseListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PageNumber<PurchaseListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|PurchaseListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PurchaseListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/purchases/',
            query: Util::array_transform_keys($parsed, ['pageSize' => 'page_size']),
            options: $options,
            convert: PurchaseListResponse::class,
            page: PageNumber::class,
        );
    }

    /**
     * @api
     *
     * Refunds a purchase if verification code was not received within 20 minutes.
     *
     * **Requirements:**
     * - Status `PENDING`, code not received
     * - At least 20 minutes since purchase creation
     *
     * @param int $purchaseID unique purchase identifier
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PurchaseRefundResponse>
     *
     * @throws APIException
     */
    public function refund(
        int $purchaseID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/purchases/%1$s/refund', $purchaseID],
            options: $requestOptions,
            convert: PurchaseRefundResponse::class,
        );
    }

    /**
     * @api
     *
     * Requests verification code and password from provider. Updates purchase status to SUCCESS.
     *
     * **Idempotent Operation.** Safe to retry on network errors - will not generate duplicate codes.
     *
     * **Behavior.**
     * - First call: Fetches code from provider, updates status to `SUCCESS`
     * - Subsequent calls: Returns conflict error (use `GET /purchases/:id` to retrieve existing code)
     *
     * **Provider timeout.** Code retrieval may take 5-30 seconds depending on provider availability.
     *
     * **Webhook notification.** Optionally provide `callback_url` to receive a POST webhook when code is retrieved. See [Webhooks](#tag/webhooks) section for payload structure and **Models** section for `WebhookSuccessPayload` / `WebhookFailedPayload` schemas.
     *
     * @param int $purchaseID unique purchase identifier
     * @param array{callbackURL?: string}|PurchaseRequestVerificationCodeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PurchaseRequestVerificationCodeResponse>
     *
     * @throws APIException
     */
    public function requestVerificationCode(
        int $purchaseID,
        array|PurchaseRequestVerificationCodeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PurchaseRequestVerificationCodeParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['v1/purchases/%1$s/request-code', $purchaseID],
            body: (object) $parsed,
            options: $options,
            convert: PurchaseRequestVerificationCodeResponse::class,
        );
    }
}
