<?php

declare(strict_types=1);

namespace Gmt\Service;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * Successful response.
 *
 * @phpstan-type ServiceGetServerTimeResponseShape = array{
 *   epochMs: int, iso: string, timezone: string
 * }
 */
final class ServiceGetServerTimeResponse implements BaseModel
{
    /** @use SdkModel<ServiceGetServerTimeResponseShape> */
    use SdkModel;

    /**
     * Current server time in milliseconds since Unix epoch.
     */
    #[Required]
    public int $epochMs;

    /**
     * Current server time in ISO 8601 format.
     */
    #[Required]
    public string $iso;

    /**
     * Server timezone.
     */
    #[Required]
    public string $timezone;

    /**
     * `new ServiceGetServerTimeResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ServiceGetServerTimeResponse::with(epochMs: ..., iso: ..., timezone: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ServiceGetServerTimeResponse)
     *   ->withEpochMs(...)
     *   ->withISO(...)
     *   ->withTimezone(...)
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
        int $epochMs,
        string $iso,
        string $timezone
    ): self {
        $self = new self;

        $self['epochMs'] = $epochMs;
        $self['iso'] = $iso;
        $self['timezone'] = $timezone;

        return $self;
    }

    /**
     * Current server time in milliseconds since Unix epoch.
     */
    public function withEpochMs(int $epochMs): self
    {
        $self = clone $this;
        $self['epochMs'] = $epochMs;

        return $self;
    }

    /**
     * Current server time in ISO 8601 format.
     */
    public function withISO(string $iso): self
    {
        $self = clone $this;
        $self['iso'] = $iso;

        return $self;
    }

    /**
     * Server timezone.
     */
    public function withTimezone(string $timezone): self
    {
        $self = clone $this;
        $self['timezone'] = $timezone;

        return $self;
    }
}
