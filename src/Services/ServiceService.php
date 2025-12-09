<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\RequestOptions;
use Gmt\Service\ServiceGetServerTimeResponse;
use Gmt\Service\ServiceHealthCheckResponse;
use Gmt\ServiceContracts\ServiceContract;

final class ServiceService implements ServiceContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Useful for client synchronization and checking clock drift.
     *
     * @throws APIException
     */
    public function getServerTime(
        ?RequestOptions $requestOptions = null
    ): ServiceGetServerTimeResponse {
        /** @var BaseResponse<ServiceGetServerTimeResponse> */
        $response = $this->client->request(
            method: 'get',
            path: 'v1/service/time',
            options: $requestOptions,
            convert: ServiceGetServerTimeResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns basic service status, current time, and process uptime.
     *
     * @throws APIException
     */
    public function healthCheck(
        ?RequestOptions $requestOptions = null
    ): ServiceHealthCheckResponse {
        /** @var BaseResponse<ServiceHealthCheckResponse> */
        $response = $this->client->request(
            method: 'get',
            path: 'v1/service/health',
            options: $requestOptions,
            convert: ServiceHealthCheckResponse::class,
        );

        return $response->parse();
    }
}
