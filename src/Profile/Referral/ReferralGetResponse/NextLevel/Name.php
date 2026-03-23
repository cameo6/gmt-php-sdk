<?php

declare(strict_types=1);

namespace Gmt\Profile\Referral\ReferralGetResponse\NextLevel;

/**
 * Name of the next referral level.
 */
enum Name: string
{
    case BRONZE = 'bronze';

    case SILVER = 'silver';

    case GOLD = 'gold';

    case PLATINUM = 'platinum';
}
