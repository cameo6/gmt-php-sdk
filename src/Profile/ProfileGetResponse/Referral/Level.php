<?php

declare(strict_types=1);

namespace GmtPhpSDK\Profile\ProfileGetResponse\Referral;

/**
 * Current referral program level: bronze, silver, gold, platinum.
 */
enum Level: string
{
    case BRONZE = 'bronze';

    case SILVER = 'silver';

    case GOLD = 'gold';

    case PLATINUM = 'platinum';
}
