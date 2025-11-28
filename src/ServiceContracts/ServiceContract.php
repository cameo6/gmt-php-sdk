<?php

declare(strict_types=1);

namespace GmtPhpSDK\ServiceContracts;

use GmtPhpSDK\Core\Exceptions\APIException;
use GmtPhpSDK\RequestOptions;
use GmtPhpSDK\Service\ServiceGetServerTimeResponse;
use GmtPhpSDK\Service\ServiceHealthCheckResponse;

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
