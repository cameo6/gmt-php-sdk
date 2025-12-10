<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\RequestOptions;
use Gmt\Service\ServiceGetServerTimeResponse;
use Gmt\Service\ServiceHealthCheckResponse;
use Gmt\ServiceContracts\ServiceRawContract;

final class ServiceRawService implements ServiceRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Useful for client synchronization and checking clock drift.
     *
     * @return BaseResponse<ServiceGetServerTimeResponse>
     *
     * @throws APIException
     */
    public function getServerTime(
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/service/time',
            options: $requestOptions,
            convert: ServiceGetServerTimeResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns basic service status, current time, and process uptime.
     *
     * @return BaseResponse<ServiceHealthCheckResponse>
     *
     * @throws APIException
     */
    public function healthCheck(
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/service/health',
            options: $requestOptions,
            convert: ServiceHealthCheckResponse::class,
        );
    }
}
