<?php

declare(strict_types=1);

namespace Gmt\Webhooks\WebhookTestParams;

/**
 * Webhook payload type to send: `success` or `failed`.
 */
enum Type: string
{
    case SUCCESS = 'success';

    case FAILED = 'failed';
}
