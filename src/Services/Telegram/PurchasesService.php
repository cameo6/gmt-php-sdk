<?php

declare(strict_types=1);

namespace Gmt\Services\Telegram;

use Gmt\Client;
use Gmt\ServiceContracts\Telegram\PurchasesContract;

final class PurchasesService implements PurchasesContract
{
    /**
     * @api
     */
    public PurchasesRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PurchasesRawService($client);
    }
}
