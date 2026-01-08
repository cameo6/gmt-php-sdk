<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\RequestOptions;
use Gmt\Webhooks\WebhookTestParams;
use Gmt\Webhooks\WebhookTestResponse;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface WebhooksRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|WebhookTestParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookTestResponse>
     *
     * @throws APIException
     */
    public function test(
        array|WebhookTestParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
