<?php

declare(strict_types=1);

namespace Gmt\Webhooks;

use Gmt\Core\Attributes\Optional;
use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Webhooks\WebhookTestParams\Type;

/**
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
 * @see Gmt\Services\WebhooksService::test()
 *
 * @phpstan-type WebhookTestParamsShape = array{
 *   url: string, type?: null|Type|value-of<Type>
 * }
 */
final class WebhookTestParams implements BaseModel
{
    /** @use SdkModel<WebhookTestParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Webhook endpoint URL. Must be a valid URL.
     */
    #[Required]
    public string $url;

    /**
     * Webhook payload type to send: `success` or `failed`.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * `new WebhookTestParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookTestParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookTestParams)->withURL(...)
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
     *
     * @param Type|value-of<Type>|null $type
     */
    public static function with(string $url, Type|string|null $type = null): self
    {
        $self = new self;

        $self['url'] = $url;

        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Webhook endpoint URL. Must be a valid URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Webhook payload type to send: `success` or `failed`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
