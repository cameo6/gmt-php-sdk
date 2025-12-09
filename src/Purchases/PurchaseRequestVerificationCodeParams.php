<?php

declare(strict_types=1);

namespace Gmt\Purchases;

use Gmt\Core\Attributes\Optional;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

/**
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
 * @see Gmt\Services\PurchasesService::requestVerificationCode()
 *
 * @phpstan-type PurchaseRequestVerificationCodeParamsShape = array{
 *   callbackURL?: string
 * }
 */
final class PurchaseRequestVerificationCodeParams implements BaseModel
{
    /** @use SdkModel<PurchaseRequestVerificationCodeParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * URL to receive webhook notification when code is received. POST request will be sent with either `WebhookSuccessPayload` or `WebhookFailedPayload`.
     *
     * **Retry policy.** If your endpoint does not return HTTP 200, webhook will be retried up to 3 times with delays: immediately, after 10 seconds, after 30 seconds. Any non-200 response triggers retry.
     */
    #[Optional('callback_url')]
    public ?string $callbackURL;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $callbackURL = null): self
    {
        $obj = new self;

        null !== $callbackURL && $obj['callbackURL'] = $callbackURL;

        return $obj;
    }

    /**
     * URL to receive webhook notification when code is received. POST request will be sent with either `WebhookSuccessPayload` or `WebhookFailedPayload`.
     *
     * **Retry policy.** If your endpoint does not return HTTP 200, webhook will be retried up to 3 times with delays: immediately, after 10 seconds, after 30 seconds. Any non-200 response triggers retry.
     */
    public function withCallbackURL(string $callbackURL): self
    {
        $obj = clone $this;
        $obj['callbackURL'] = $callbackURL;

        return $obj;
    }
}
