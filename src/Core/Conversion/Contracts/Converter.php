<?php

declare(strict_types=1);

namespace Gmt\Core\Conversion\Contracts;

use Gmt\Core\Conversion\CoerceState;
use Gmt\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
