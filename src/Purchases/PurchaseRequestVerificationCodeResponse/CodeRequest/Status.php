<?php

declare(strict_types=1);

namespace Gmt\Purchases\PurchaseRequestVerificationCodeResponse\CodeRequest;

/**
 * Current status of the code request.
 */
enum Status: string
{
    case NOT_REQUESTED = 'not_requested';

    case PENDING = 'pending';

    case SUCCESS = 'success';

    case FAILED = 'failed';
}
