<?php

declare(strict_types=1);

namespace Gmt\Telegram\Purchases\PurchaseNewPremiumResponse;

/**
 * The status of the purchase.
 */
enum Status: string
{
    case SUCCESS = 'success';

    case FAILURE = 'failure';
}
