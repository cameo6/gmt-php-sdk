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
        $obj = new self;

        $obj['success'] = $success;

        null !== $error && $obj['error'] = $error;
        null !== $httpCode && $obj['httpCode'] = $httpCode;
        null !== $responseBody && $obj['responseBody'] = $responseBody;
        null !== $responseTimeMs && $obj['responseTimeMs'] = $responseTimeMs;

        return $obj;
    }

    /**
     * Whether the webhook was delivered successfully (HTTP 200).
     */
    public function withSuccess(bool $success): self
    {
        $obj = clone $this;
        $obj['success'] = $success;

        return $obj;
    }

    /**
     * Error message if delivery failed.
     */
    public function withError(string $error): self
    {
        $obj = clone $this;
        $obj['error'] = $error;

        return $obj;
    }

    /**
     * HTTP status code returned by your endpoint.
     */
    public function withHTTPCode(int $httpCode): self
    {
        $obj = clone $this;
        $obj['httpCode'] = $httpCode;

        return $obj;
    }

    /**
     * Response body from your endpoint (truncated to 1000 characters).
     */
    public function withResponseBody(string $responseBody): self
    {
        $obj = clone $this;
        $obj['responseBody'] = $responseBody;

        return $obj;
    }

    /**
     * Response time in milliseconds.
     */
    public function withResponseTimeMs(int $responseTimeMs): self
    {
        $obj = clone $this;
        $obj['responseTimeMs'] = $responseTimeMs;

        return $obj;
    }
}
