<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\Core\Exceptions\APIException;
use Gmt\PageNumber;
use Gmt\Purchases\PurchaseCreateParams;
use Gmt\Purchases\PurchaseGetResponse;
use Gmt\Purchases\PurchaseListParams;
use Gmt\Purchases\PurchaseListResponse;
use Gmt\Purchases\PurchaseNewResponse;
use Gmt\Purchases\PurchaseRequestVerificationCodeParams;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\PurchasesContract;

final class PurchasesService implements PurchasesContract
{
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
     * @param array{country_code: string}|PurchaseCreateParams $params
     *
     * @throws APIException
     */
    public function create(
        array|PurchaseCreateParams $params,
        ?RequestOptions $requestOptions = null
    ): PurchaseNewResponse {
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
     * @throws APIException
     */
    public function retrieve(
        int $purchaseID,
        ?RequestOptions $requestOptions = null
    ): PurchaseGetResponse {
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
     *   page?: int, page_size?: int, status?: 'PENDING'|'SUCCESS'|'ERROR'|'REFUND'
     * }|PurchaseListParams $params
     *
     * @return PageNumber<PurchaseListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|PurchaseListParams $params,
        ?RequestOptions $requestOptions = null
    ): PageNumber {
        [$parsed, $options] = PurchaseListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/purchases/',
            query: $parsed,
            options: $options,
            convert: PurchaseListResponse::class,
            page: PageNumber::class,
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
     * @param array{
     *   callback_url?: string
     * }|PurchaseRequestVerificationCodeParams $params
     *
     * @throws APIException
     */
    public function requestVerificationCode(
        int $purchaseID,
        array|PurchaseRequestVerificationCodeParams $params,
        ?RequestOptions $requestOptions = null,
    ): PurchaseRequestVerificationCodeResponse {
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
