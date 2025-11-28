<?php

declare(strict_types=1);

namespace Gmt\Service\ServiceHealthCheckResponse;

/**
 * Service status.
 */
enum Status: string
{
    case OK = 'ok';

    case DEGRADED = 'degraded';
}
