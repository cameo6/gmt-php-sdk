<?php

declare(strict_types=1);

namespace Gmt\Accounts\AccountListResponse;

/**
 * Tag indicating account quality or demand status.
 */
enum Tag: string
{
    case HIGH_QUALITY = 'HIGH_QUALITY';

    case HIGH_DEMAND = 'HIGH_DEMAND';
}
