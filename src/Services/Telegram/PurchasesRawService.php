<?php

declare(strict_types=1);

namespace Gmt\Services\Telegram;

use Gmt\Client;
use Gmt\ServiceContracts\Telegram\PurchasesRawContract;

final class PurchasesRawService implements PurchasesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
