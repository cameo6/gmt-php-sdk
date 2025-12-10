<?php

declare(strict_types=1);

namespace Gmt\Webhooks;

use Gmt\Core\Attributes\Optional;
use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * Result of webhook test request.
 *
 * @phpstan-type WebhookTestResponseShape = array{
 *   success: bool,
 *   error?: string|null,
 *   httpCode?: int|null,
 *   responseBody?: string|null,
 *   responseTimeMs?: int|null,
 * }
 */
final class WebhookTestResponse implements BaseModel
{
    /** @use SdkModel<WebhookTestResponseShape> */
    use SdkModel;

    /**
     * Whether the webhook was delivered successfully (HTTP 200).
     */
    #[Required]
    public bool $success;

    /**
     * Error message if delivery failed.
     */
    #[Optional]
    public ?string $error;

    /**
     * HTTP status code returned by your endpoint.
     */
    #[Optional('http_code')]
    public ?int $httpCode;

    /**
     * Response body from your endpoint (truncated to 1000 characters).
     */
    #[Optional('response_body')]
    public ?string $responseBody;

    /**
     * Response time in milliseconds.
     */
    #[Optional('response_time_ms')]
    public ?int $responseTimeMs;

    /**
     * `new WebhookTestResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookTestResponse::with(success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookTestResponse)->withSuccess(...)
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
        bool $success,
        ?string $error = null,
        ?int $httpCode = null,
        ?string $responseBody = null,
        ?int $responseTimeMs = null,
    ): self {
        $self = new self;

        $self['success'] = $success;

        null !== $error && $self['error'] = $error;
        null !== $httpCode && $self['httpCode'] = $httpCode;
        null !== $responseBody && $self['responseBody'] = $responseBody;
        null !== $responseTimeMs && $self['responseTimeMs'] = $responseTimeMs;

        return $self;
    }

    /**
     * Whether the webhook was delivered successfully (HTTP 200).
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * Error message if delivery failed.
     */
    public function withError(string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * HTTP status code returned by your endpoint.
     */
    public function withHTTPCode(int $httpCode): self
    {
        $self = clone $this;
        $self['httpCode'] = $httpCode;

        return $self;
    }

    /**
     * Response body from your endpoint (truncated to 1000 characters).
     */
    public function withResponseBody(string $responseBody): self
    {
        $self = clone $this;
        $self['responseBody'] = $responseBody;

        return $self;
    }

    /**
     * Response time in milliseconds.
     */
    public function withResponseTimeMs(int $responseTimeMs): self
    {
        $self = clone $this;
        $self['responseTimeMs'] = $responseTimeMs;

        return $self;
    }
}
