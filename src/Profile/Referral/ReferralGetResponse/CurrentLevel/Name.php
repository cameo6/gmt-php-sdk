<?php

declare(strict_types=1);

namespace Gmt\Profile\Referral\ReferralGetResponse\CurrentLevel;

/**
 * Name of the current referral level.
 */
enum Name: string
{
    case BRONZE = 'bronze';

    case SILVER = 'silver';

    case GOLD = 'gold';

    case PLATINUM = 'platinum';
}
