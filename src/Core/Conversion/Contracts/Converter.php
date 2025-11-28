<?php

declare(strict_types=1);

namespace GmtPhpSDK\Core\Conversion\Contracts;

use GmtPhpSDK\Core\Conversion\CoerceState;
use GmtPhpSDK\Core\Conversion\DumpState;

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
