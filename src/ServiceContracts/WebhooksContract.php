<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Exceptions\APIException;
use Gmt\RequestOptions;
use Gmt\Webhooks\WebhookTestParams;
use Gmt\Webhooks\WebhookTestResponse;

interface WebhooksContract
{
    /**
     * @api
     *
     * @param array<mixed>|WebhookTestParams $params
     *
     * @throws APIException
     */
    public function test(
        array|WebhookTestParams $params,
        ?RequestOptions $requestOptions = null
    ): WebhookTestResponse;
}
