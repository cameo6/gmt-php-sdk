<?php

declare(strict_types=1);

namespace Gmt\Purchases\PurchaseNewResponse;

/**
 * **Purchase Status Lifecycle.** `PENDING` (initial) → `SUCCESS` (after code request) or `ERROR` (provider failure). Any status can transition to `REFUND` via admin action.
 *
 * **Important.** Status is immutable once set to `SUCCESS`, `ERROR`, or `REFUND`.
 *
 * **Filter options**
 * - `PENDING` - code not requested.
 * - `SUCCESS` - code ready.
 * - `ERROR` - provider failed.
 * - `REFUND` - money returned.
 */
enum Status: string
{
    case PENDING = 'PENDING';

    case SUCCESS = 'SUCCESS';

    case ERROR = 'ERROR';

    case REFUND = 'REFUND';
}
