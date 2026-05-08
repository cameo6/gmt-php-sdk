<?php

declare(strict_types=1);

namespace Gmt\Profile\ProfileGetResponse;

/**
 * Preferred user interface language; null until the user selects one.
 */
enum Language: string
{
    case RU = 'ru';

    case UK = 'uk';

    case EN = 'en';

    case ES = 'es';

    case ZH = 'zh';
}
