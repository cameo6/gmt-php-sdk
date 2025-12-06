<?php

declare(strict_types=1);

namespace Gmt\Service\ServiceHealthCheckResponse;

use Gmt\Core\Attributes\Api;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * Detailed information about dependencies state.
 *
 * @phpstan-type ChecksShape = array{database: bool, redis: bool}
 */
final class Checks implements BaseModel
{
    /** @use SdkModel<ChecksShape> */
    use SdkModel;

    /**
     * Database connection status.
     */
    #[Api]
    public bool $database;

    /**
     * Redis connection status.
     */
    #[Api]
    public bool $redis;

    /**
     * `new Checks()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Checks::with(database: ..., redis: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Checks)->withDatabase(...)->withRedis(...)
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
    public static function with(bool $database, bool $redis): self
    {
        $obj = new self;

        $obj['database'] = $database;
        $obj['redis'] = $redis;

        return $obj;
    }

    /**
     * Database connection status.
     */
    public function withDatabase(bool $database): self
    {
        $obj = clone $this;
        $obj['database'] = $database;

        return $obj;
    }

    /**
     * Redis connection status.
     */
    public function withRedis(bool $redis): self
    {
        $obj = clone $this;
        $obj['redis'] = $redis;

        return $obj;
    }
}
