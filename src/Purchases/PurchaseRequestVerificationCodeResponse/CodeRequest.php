<?php

declare(strict_types=1);

namespace Gmt\Purchases\PurchaseRequestVerificationCodeResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\CodeRequest\Status;

/**
 * @phpstan-type CodeRequestShape = array{
 *   attempt: int,
 *   max_attempts: int,
 *   next_attempt_at: string|null,
 *   retry_after: int|null,
 *   status: value-of<Status>,
 * }
 */
final class CodeRequest implements BaseModel
{
    /** @use SdkModel<CodeRequestShape> */
    use SdkModel;

    /**
     * Current attempt number.
     */
    #[Required]
    public int $attempt;

    /**
     * Maximum number of attempts.
     */
    #[Required]
    public int $max_attempts;

    /**
     * ISO timestamp of next attempt (null if not scheduled).
     */
    #[Required]
    public ?string $next_attempt_at;

    /**
     * Seconds until next attempt (null if not scheduled).
     */
    #[Required]
    public ?int $retry_after;

    /**
     * Current status of the code request.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * `new CodeRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CodeRequest::with(
     *   attempt: ...,
     *   max_attempts: ...,
     *   next_attempt_at: ...,
     *   retry_after: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CodeRequest)
     *   ->withAttempt(...)
     *   ->withMaxAttempts(...)
     *   ->withNextAttemptAt(...)
     *   ->withRetryAfter(...)
     *   ->withStatus(...)
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
     * @param Status|value-of<Status> $status
     */
    public static function with(
        int $attempt,
        int $max_attempts,
        ?string $next_attempt_at,
        ?int $retry_after,
        Status|string $status,
    ): self {
        $obj = new self;

        $obj['attempt'] = $attempt;
        $obj['max_attempts'] = $max_attempts;
        $obj['next_attempt_at'] = $next_attempt_at;
        $obj['retry_after'] = $retry_after;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * Current attempt number.
     */
    public function withAttempt(int $attempt): self
    {
        $obj = clone $this;
        $obj['attempt'] = $attempt;

        return $obj;
    }

    /**
     * Maximum number of attempts.
     */
    public function withMaxAttempts(int $maxAttempts): self
    {
        $obj = clone $this;
        $obj['max_attempts'] = $maxAttempts;

        return $obj;
    }

    /**
     * ISO timestamp of next attempt (null if not scheduled).
     */
    public function withNextAttemptAt(?string $nextAttemptAt): self
    {
        $obj = clone $this;
        $obj['next_attempt_at'] = $nextAttemptAt;

        return $obj;
    }

    /**
     * Seconds until next attempt (null if not scheduled).
     */
    public function withRetryAfter(?int $retryAfter): self
    {
        $obj = clone $this;
        $obj['retry_after'] = $retryAfter;

        return $obj;
    }

    /**
     * Current status of the code request.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }
}
