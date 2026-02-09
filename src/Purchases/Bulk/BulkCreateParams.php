<?php

declare(strict_types=1);

namespace Gmt\Purchases\Bulk;

use Gmt\Core\Attributes\Optional;
use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

/**
 * Creates a new wholesale purchase for the specified country. Immediately debits the balance and returns the purchase with the status “PENDING”.
 *
 * **Wholesale purchase creation process**
 * 1. Checks the availability of the country and the user's balance.
 * 2. Reserves multiple accounts with the provider.
 * 3. Atomically debits the balance and creates a bulk purchase record.
 * 4. Returns the bulk purchase with the status “PENDING”.
 *
 * **Webhook notification.** Optionally provide `callback_url` to receive a webhook when the archive is ready.
 *
 * **Next steps.** Call “GET /bulk/:purchaseId” to get the account archive link.
 *
 * @see Gmt\Services\Purchases\BulkService::create()
 *
 * @phpstan-type BulkCreateParamsShape = array{
 *   countryCode: string, quantity: int, callbackURL?: string|null
 * }
 */
final class BulkCreateParams implements BaseModel
{
    /** @use SdkModel<BulkCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * ISO 3166-1 alpha-2 country code.
     */
    #[Required('country_code')]
    public string $countryCode;

    /**
     * Number of accounts to purchase.
     */
    #[Required]
    public int $quantity;

    /**
     * URL to receive webhook notification when bulk archive is ready. POST request will be sent with `WebhookBulkReadyPayload`.
     *
     * **Retry policy.** If your endpoint does not return HTTP 200, webhook will be retried up to 3 times with delays: immediately, after 10 seconds, after 30 seconds. Any non-200 response triggers retry.
     */
    #[Optional('callback_url')]
    public ?string $callbackURL;

    /**
     * `new BulkCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkCreateParams::with(countryCode: ..., quantity: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkCreateParams)->withCountryCode(...)->withQuantity(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $countryCode,
        int $quantity,
        ?string $callbackURL = null
    ): self {
        $self = new self;

        $self['countryCode'] = $countryCode;
        $self['quantity'] = $quantity;

        null !== $callbackURL && $self['callbackURL'] = $callbackURL;

        return $self;
    }

    /**
     * ISO 3166-1 alpha-2 country code.
     */
    public function withCountryCode(string $countryCode): self
    {
        $self = clone $this;
        $self['countryCode'] = $countryCode;

        return $self;
    }

    /**
     * Number of accounts to purchase.
     */
    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * URL to receive webhook notification when bulk archive is ready. POST request will be sent with `WebhookBulkReadyPayload`.
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
