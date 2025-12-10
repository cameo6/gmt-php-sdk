<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Exceptions\APIException;
use Gmt\RequestOptions;
use Gmt\Webhooks\WebhookTestParams\Type;
use Gmt\Webhooks\WebhookTestResponse;

interface WebhooksContract
{
    /**
     * @api
     *
     * @param string $url Webhook endpoint URL. Must be a valid URL.
     * @param 'success'|'failed'|Type $type webhook payload type to send: `success` or `failed`
     *
     * @throws APIException
     */
    public function test(
        string $url,
        string|Type $type = 'success',
        ?RequestOptions $requestOptions = null,
    ): WebhookTestResponse;
}
