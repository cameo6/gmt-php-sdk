<?php

declare(strict_types=1);

namespace Gmt\Purchases\Bulk\BulkGetResponse\Item;

/**
 * Status of bulk purchase.
 */
enum Status: string
{
    case PENDING = 'PENDING';

    case SUCCESS = 'SUCCESS';

    case ERROR = 'ERROR';

    case REFUND = 'REFUND';
}
