<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\RequestOptions;
use Gmt\Service\ServiceGetServerTimeResponse;
use Gmt\Service\ServiceHealthCheckResponse;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface ServiceRawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ServiceGetServerTimeResponse>
     *
     * @throws APIException
     */
    public function getServerTime(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ServiceHealthCheckResponse>
     *
     * @throws APIException
     */
    public function healthCheck(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
