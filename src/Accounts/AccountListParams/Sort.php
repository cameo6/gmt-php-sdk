<?php

declare(strict_types=1);

namespace Gmt\Accounts\AccountListParams;

/**
 * Sort order for accounts.
 */
enum Sort: string
{
    case PRICE_ASC = 'price_asc';

    case PRICE_DESC = 'price_desc';

    case NAME_ASC = 'name_asc';

    case NAME_DESC = 'name_desc';
}
