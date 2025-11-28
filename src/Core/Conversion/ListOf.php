<?php

declare(strict_types=1);

namespace GmtPhpSDK\Core\Conversion;

use GmtPhpSDK\Core\Conversion\Concerns\ArrayOf;
use GmtPhpSDK\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    private function empty(): array|object // @phpstan-ignore-line
    {
        return [];
    }
}
