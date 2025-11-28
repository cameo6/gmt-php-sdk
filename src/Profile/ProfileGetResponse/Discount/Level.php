<?php

declare(strict_types=1);

namespace GmtPhpSDK\Profile\ProfileGetResponse\Discount;

/**
 * Current discount level: none, bronze, silver, gold, platinum, premium.
 */
enum Level: string
{
    case NONE = 'none';

    case BRONZE = 'bronze';

    case SILVER = 'silver';

    case GOLD = 'gold';

    case PLATINUM = 'platinum';

    case PREMIUM = 'premium';
}
