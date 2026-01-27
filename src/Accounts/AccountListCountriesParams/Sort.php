<?php

declare(strict_types=1);

namespace Gmt\Accounts\AccountListCountriesParams;

/**
 * Sort order for accounts.
 */
enum Sort: string
{
    case PRICE_ASC = 'price_asc';

    case PRICE_DESC = 'price_desc';

    case NAME_ASC = 'name_asc';

    case NAME_DESC = 'name_desc';

    case POPULARITY_ASC = 'popularity_asc';

    case POPULARITY_DESC = 'popularity_desc';
}
