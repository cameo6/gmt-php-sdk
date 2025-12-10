<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\RequestOptions;
use Gmt\Service\ServiceGetServerTimeResponse;
use Gmt\Service\ServiceHealthCheckResponse;

interface ServiceRawContract
{
    /**
     * @api
     *
     * @return BaseResponse<ServiceGetServerTimeResponse>
     *
     * @throws APIException
     */
    public function getServerTime(
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @return BaseResponse<ServiceHealthCheckResponse>
     *
     * @throws APIException
     */
    public function healthCheck(
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
