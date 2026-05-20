<?php

declare(strict_types=1);

namespace Gmt\Purchases\PurchaseNewResponse;

/**
 * Purchase channel: BOT (Telegram), WEB (site JWT), API (x-api-key).
 */
enum PurchaseSource: string
{
    case BOT = 'BOT';

    case WEB = 'WEB';

    case API = 'API';
}
