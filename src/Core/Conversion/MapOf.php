<?php

declare(strict_types=1);

namespace Gmt\Core\Conversion;

use Gmt\Core\Conversion\Concerns\ArrayOf;
use Gmt\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
