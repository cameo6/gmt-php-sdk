<?php

declare(strict_types=1);

namespace Gmt\Purchases\PurchaseRefundResponse\Purchase;

/**
 * Type of purchase: SINGLE (regular), BULK (batch purchase), ADMIN (admin deduction).
 */
enum PurchaseType: string
{
    case SINGLE = 'SINGLE';

    case BULK = 'BULK';

    case ADMIN = 'ADMIN';
}
