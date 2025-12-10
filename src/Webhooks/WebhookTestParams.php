<?php

declare(strict_types=1);

namespace Gmt\Webhooks;

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
 *   type: Type|value-of<Type>, url: string
 * }
 */
final class WebhookTestParams implements BaseModel
{
    /** @use SdkModel<WebhookTestParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Webhook payload type to send: `success` or `failed`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Webhook endpoint URL. Must be a valid URL.
     */
    #[Required]
    public string $url;

    /**
     * `new WebhookTestParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookTestParams::with(type: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookTestParams)->withType(...)->withURL(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $url,
        Type|string $type = 'success'
    ): self {
        $self = new self;

        $self['type'] = $type;
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

    /**
     * Webhook endpoint URL. Must be a valid URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
