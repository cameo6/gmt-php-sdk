<?php

declare(strict_types=1);

namespace Gmt\Service\ServiceHealthCheckResponse;

use Gmt\Core\Attributes\Required;
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
    #[Required]
    public bool $database;

    /**
     * Redis connection status.
     */
    #[Required]
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
        $self = new self;

        $self['database'] = $database;
        $self['redis'] = $redis;

        return $self;
    }

    /**
     * Database connection status.
     */
    public function withDatabase(bool $database): self
    {
        $self = clone $this;
        $self['database'] = $database;

        return $self;
    }

    /**
     * Redis connection status.
     */
    public function withRedis(bool $redis): self
    {
        $self = clone $this;
        $self['redis'] = $redis;

        return $self;
    }
}
