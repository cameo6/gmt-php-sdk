<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Exceptions\APIException;
use Gmt\RequestOptions;
use Gmt\Service\ServiceGetServerTimeResponse;
use Gmt\Service\ServiceHealthCheckResponse;

interface ServiceContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function getServerTime(
        ?RequestOptions $requestOptions = null
    ): ServiceGetServerTimeResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function healthCheck(
        ?RequestOptions $requestOptions = null
    ): ServiceHealthCheckResponse;
}
