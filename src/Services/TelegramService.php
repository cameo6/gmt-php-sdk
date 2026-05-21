<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\ServiceContracts\TelegramContract;
use Gmt\Services\Telegram\PurchasesService;

final class TelegramService implements TelegramContract
{
    /**
     * @api
     */
    public TelegramRawService $raw;

    /**
     * @api
     */
    public PurchasesService $purchases;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TelegramRawService($client);
        $this->purchases = new PurchasesService($client);
    }
}
