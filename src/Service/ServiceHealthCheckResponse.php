<?php

declare(strict_types=1);

namespace Gmt\Service;

use Gmt\Core\Attributes\Optional;
use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Service\ServiceHealthCheckResponse\Checks;
use Gmt\Service\ServiceHealthCheckResponse\Status;

/**
 * Successful response.
 *
 * @phpstan-type ServiceHealthCheckResponseShape = array{
 *   now: string,
 *   status: value-of<Status>,
 *   uptimeSeconds: int,
 *   checks?: Checks|null,
 * }
 */
final class ServiceHealthCheckResponse implements BaseModel
{
    /** @use SdkModel<ServiceHealthCheckResponseShape> */
    use SdkModel;

    /**
     * Current server time in ISO 8601 format.
     */
    #[Required]
    public string $now;

    /**
     * Service status.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * API uptime in seconds.
     */
    #[Required]
    public int $uptimeSeconds;

    /**
     * Detailed information about dependencies state.
     */
    #[Optional]
    public ?Checks $checks;

    /**
     * `new ServiceHealthCheckResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ServiceHealthCheckResponse::with(now: ..., status: ..., uptimeSeconds: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ServiceHealthCheckResponse)
     *   ->withNow(...)
     *   ->withStatus(...)
     *   ->withUptimeSeconds(...)
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
     * @param Checks|array{database: bool, redis: bool} $checks
     */
    public static function with(
        string $now,
        Status|string $status,
        int $uptimeSeconds,
        Checks|array|null $checks = null,
    ): self {
        $obj = new self;

        $obj['now'] = $now;
        $obj['status'] = $status;
        $obj['uptimeSeconds'] = $uptimeSeconds;

        null !== $checks && $obj['checks'] = $checks;

        return $obj;
    }

    /**
     * Current server time in ISO 8601 format.
     */
    public function withNow(string $now): self
    {
        $obj = clone $this;
        $obj['now'] = $now;

        return $obj;
    }

    /**
     * Service status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * API uptime in seconds.
     */
    public function withUptimeSeconds(int $uptimeSeconds): self
    {
        $obj = clone $this;
        $obj['uptimeSeconds'] = $uptimeSeconds;

        return $obj;
    }

    /**
     * Detailed information about dependencies state.
     *
     * @param Checks|array{database: bool, redis: bool} $checks
     */
    public function withChecks(Checks|array $checks): self
    {
        $obj = clone $this;
        $obj['checks'] = $checks;

        return $obj;
    }
}
