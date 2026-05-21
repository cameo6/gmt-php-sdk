<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\ServiceContracts\TelegramRawContract;

final class TelegramRawService implements TelegramRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
