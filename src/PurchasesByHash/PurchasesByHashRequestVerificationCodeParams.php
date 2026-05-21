<?php

declare(strict_types=1);

namespace Gmt\PurchasesByHash;

use Gmt\Core\Attributes\Optional;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

/**
 * Requests verification code and password from provider using purchase hash code. Updates purchase status to SUCCESS.
 *
 * **No authentication required.** The hash code serves as the access token.
 *
 * **Idempotent Operation.** Safe to retry on network errors - will not generate duplicate codes.
 *
 * **Path parameter `hash`.** If it is missing or empty before `/request-code` (e.g. `/v1/purchases-by-hash/request-code`), the API returns **400** with `fieldViolations` on `hash`.
 *
 * @see Gmt\Services\PurchasesByHashService::requestVerificationCode()
 *
 * @phpstan-type PurchasesByHashRequestVerificationCodeParamsShape = array{
 *   callbackURL?: string|null
 * }
 */
final class PurchasesByHashRequestVerificationCodeParams implements BaseModel
{
    /** @use SdkModel<PurchasesByHashRequestVerificationCodeParamsShape> */
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
        $self = new self;

        null !== $callbackURL && $self['callbackURL'] = $callbackURL;

        return $self;
    }

    /**
     * URL to receive webhook notification when code is received. POST request will be sent with either `WebhookSuccessPayload` or `WebhookFailedPayload`.
     *
     * **Retry policy.** If your endpoint does not return HTTP 200, webhook will be retried up to 3 times with delays: immediately, after 10 seconds, after 30 seconds. Any non-200 response triggers retry.
     */
    public function withCallbackURL(string $callbackURL): self
    {
        $self = clone $this;
        $self['callbackURL'] = $callbackURL;

        return $self;
    }
}
