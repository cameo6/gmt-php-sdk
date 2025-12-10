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
 *   maxAttempts: int,
 *   nextAttemptAt: string|null,
 *   retryAfter: int|null,
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
    #[Required('max_attempts')]
    public int $maxAttempts;

    /**
     * ISO timestamp of next attempt (null if not scheduled).
     */
    #[Required('next_attempt_at')]
    public ?string $nextAttemptAt;

    /**
     * Seconds until next attempt (null if not scheduled).
     */
    #[Required('retry_after')]
    public ?int $retryAfter;

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
     *   maxAttempts: ...,
     *   nextAttemptAt: ...,
     *   retryAfter: ...,
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
        int $maxAttempts,
        ?string $nextAttemptAt,
        ?int $retryAfter,
        Status|string $status,
    ): self {
        $self = new self;

        $self['attempt'] = $attempt;
        $self['maxAttempts'] = $maxAttempts;
        $self['nextAttemptAt'] = $nextAttemptAt;
        $self['retryAfter'] = $retryAfter;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Current attempt number.
     */
    public function withAttempt(int $attempt): self
    {
        $self = clone $this;
        $self['attempt'] = $attempt;

        return $self;
    }

    /**
     * Maximum number of attempts.
     */
    public function withMaxAttempts(int $maxAttempts): self
    {
        $self = clone $this;
        $self['maxAttempts'] = $maxAttempts;

        return $self;
    }

    /**
     * ISO timestamp of next attempt (null if not scheduled).
     */
    public function withNextAttemptAt(?string $nextAttemptAt): self
    {
        $self = clone $this;
        $self['nextAttemptAt'] = $nextAttemptAt;

        return $self;
    }

    /**
     * Seconds until next attempt (null if not scheduled).
     */
    public function withRetryAfter(?int $retryAfter): self
    {
        $self = clone $this;
        $self['retryAfter'] = $retryAfter;

        return $self;
    }

    /**
     * Current status of the code request.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
