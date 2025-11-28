<?php

declare(strict_types=1);

namespace GmtPhpSDK\Core\Conversion;

use GmtPhpSDK\Core\Conversion\Concerns\ArrayOf;
use GmtPhpSDK\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
