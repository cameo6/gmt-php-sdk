<?php

declare(strict_types=1);

namespace Gmt\Profile\ProfileChangeLanguageParams;

/**
 * Preferred user interface language.
 */
enum Language: string
{
    case RU = 'ru';

    case UA = 'ua';

    case EN = 'en';

    case ES = 'es';

    case ZH = 'zh';
}
