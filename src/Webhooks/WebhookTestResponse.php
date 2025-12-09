<?php

declare(strict_types=1);

namespace Gmt\Webhooks;

use Gmt\Core\Attributes\Api;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * Result of webhook test request.
 *
 * @phpstan-type WebhookTestResponseShape = array{
 *   success: bool,
 *   error?: string|null,
 *   http_code?: int|null,
 *   response_body?: string|null,
 *   response_time_ms?: int|null,
 * }
 */
final class WebhookTestResponse implements BaseModel
{
    /** @use SdkModel<WebhookTestResponseShape> */
    use SdkModel;

    /**
     * Whether the webhook was delivered successfully (HTTP 200).
     */
    #[Api]
    public bool $success;

    /**
     * Error message if delivery failed.
     */
    #[Api(optional: true)]
    public ?string $error;

    /**
     * HTTP status code returned by your endpoint.
     */
    #[Api(optional: true)]
    public ?int $http_code;

    /**
     * Response body from your endpoint (truncated to 1000 characters).
     */
    #[Api(optional: true)]
    public ?string $response_body;

    /**
     * Response time in milliseconds.
     */
    #[Api(optional: true)]
    public ?int $response_time_ms;

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
        ?int $http_code = null,
        ?string $response_body = null,
        ?int $response_time_ms = null,
    ): self {
        $obj = new self;

        $obj['success'] = $success;

        null !== $error && $obj['error'] = $error;
        null !== $http_code && $obj['http_code'] = $http_code;
        null !== $response_body && $obj['response_body'] = $response_body;
        null !== $response_time_ms && $obj['response_time_ms'] = $response_time_ms;

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
        $obj['http_code'] = $httpCode;

        return $obj;
    }

    /**
     * Response body from your endpoint (truncated to 1000 characters).
     */
    public function withResponseBody(string $responseBody): self
    {
        $obj = clone $this;
        $obj['response_body'] = $responseBody;

        return $obj;
    }

    /**
     * Response time in milliseconds.
     */
    public function withResponseTimeMs(int $responseTimeMs): self
    {
        $obj = clone $this;
        $obj['response_time_ms'] = $responseTimeMs;

        return $obj;
    }
}
