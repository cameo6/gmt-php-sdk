<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Exceptions\APIException;
use Gmt\RequestOptions;
use Gmt\Webhooks\WebhookTestParams\Type;
use Gmt\Webhooks\WebhookTestResponse;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface WebhooksContract
{
    /**
     * @api
     *
     * @param string $url Webhook endpoint URL. Must be a valid URL.
     * @param Type|value-of<Type> $type webhook payload type to send: `success` or `failed`
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function test(
        string $url,
        Type|string $type = 'success',
        RequestOptions|array|null $requestOptions = null,
    ): WebhookTestResponse;
}
