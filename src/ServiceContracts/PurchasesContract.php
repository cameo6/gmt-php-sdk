<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Exceptions\APIException;
use Gmt\PageNumber;
use Gmt\Purchases\PurchaseGetResponse;
use Gmt\Purchases\PurchaseListParams\Status;
use Gmt\Purchases\PurchaseListResponse;
use Gmt\Purchases\PurchaseNewResponse;
use Gmt\Purchases\PurchaseRefundResponse;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse;
use Gmt\RequestOptions;

interface PurchasesContract
{
    /**
     * @api
     *
     * @param string $countryCode ISO 3166-1 alpha-2 country code
     *
     * @throws APIException
     */
    public function create(
        string $countryCode,
        ?RequestOptions $requestOptions = null
    ): PurchaseNewResponse;

    /**
     * @api
     *
     * @param int $purchaseID unique purchase identifier
     *
     * @throws APIException
     */
    public function retrieve(
        int $purchaseID,
        ?RequestOptions $requestOptions = null
    ): PurchaseGetResponse;

    /**
     * @api
     *
     * @param int $page page number
     * @param int $pageSize number of items per page
     * @param 'PENDING'|'SUCCESS'|'ERROR'|'REFUND'|Status $status **Purchase Status Lifecycle.** `PENDING` (initial) → `SUCCESS` (after code request) or `ERROR` (provider failure). Any status can transition to `REFUND` via admin action.
     *
     * **Important.** Status is immutable once set to `SUCCESS`, `ERROR`, or `REFUND`.
     *
     * **Filter options**
     * - `PENDING` - code not requested.
     * - `SUCCESS` - code ready.
     * - `ERROR` - provider failed.
     * - `REFUND` - money returned.
     *
     * @return PageNumber<PurchaseListResponse>
     *
     * @throws APIException
     */
    public function list(
        int $page = 1,
        int $pageSize = 50,
        string|Status|null $status = null,
        ?RequestOptions $requestOptions = null,
    ): PageNumber;

    /**
     * @api
     *
     * @param int $purchaseID unique purchase identifier
     *
     * @throws APIException
     */
    public function refund(
        int $purchaseID,
        ?RequestOptions $requestOptions = null
    ): PurchaseRefundResponse;

    /**
     * @api
     *
     * @param int $purchaseID unique purchase identifier
     * @param string $callbackURL URL to receive webhook notification when code is received. POST request will be sent with either `WebhookSuccessPayload` or `WebhookFailedPayload`.
     *
     * **Retry policy.** If your endpoint does not return HTTP 200, webhook will be retried up to 3 times with delays: immediately, after 10 seconds, after 30 seconds. Any non-200 response triggers retry.
     *
     * @throws APIException
     */
    public function requestVerificationCode(
        int $purchaseID,
        ?string $callbackURL = null,
        ?RequestOptions $requestOptions = null,
    ): PurchaseRequestVerificationCodeResponse;
}
