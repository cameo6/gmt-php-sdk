<?php

declare(strict_types=1);

namespace GmtPhpSDK\Services;

use GmtPhpSDK\Client;
use GmtPhpSDK\Core\Exceptions\APIException;
use GmtPhpSDK\RequestOptions;
use GmtPhpSDK\Service\ServiceGetServerTimeResponse;
use GmtPhpSDK\Service\ServiceHealthCheckResponse;
use GmtPhpSDK\ServiceContracts\ServiceContract;

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
        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function healthCheck(
        ?RequestOptions $requestOptions = null
    ): ServiceHealthCheckResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'v1/service/health',
            options: $requestOptions,
            convert: ServiceHealthCheckResponse::class,
        );
    }
}
