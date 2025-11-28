<?php

declare(strict_types=1);

namespace Gmt\Accounts\AccountListParams;

use Gmt\Core\Concerns\SdkUnion;
use Gmt\Core\Conversion\Contracts\Converter;
use Gmt\Core\Conversion\Contracts\ConverterSource;
use Gmt\Core\Conversion\ListOf;

/**
 * Filter by country codes (comma-separated, e.g., 'US,RU,GB').
 */
final class CountryCode implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['string', new ListOf('string')];
    }
}
