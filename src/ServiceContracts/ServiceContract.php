<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Exceptions\APIException;
use Gmt\RequestOptions;
use Gmt\Service\ServiceGetServerTimeResponse;
use Gmt\Service\ServiceHealthCheckResponse;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface ServiceContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getServerTime(
        RequestOptions|array|null $requestOptions = null
    ): ServiceGetServerTimeResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function healthCheck(
        RequestOptions|array|null $requestOptions = null
    ): ServiceHealthCheckResponse;
}
