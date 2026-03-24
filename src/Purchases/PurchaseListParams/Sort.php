<?php

declare(strict_types=1);

namespace Gmt\Purchases\PurchaseListParams;

/**
 * Sort purchases by creation date.
 */
enum Sort: string
{
    case DATE_ASC = 'date_asc';

    case DATE_DESC = 'date_desc';
}
