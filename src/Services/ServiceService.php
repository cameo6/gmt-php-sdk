<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\Core\Exceptions\APIException;
use Gmt\RequestOptions;
use Gmt\Service\ServiceGetServerTimeResponse;
use Gmt\Service\ServiceHealthCheckResponse;
use Gmt\ServiceContracts\ServiceContract;

final class ServiceService implements ServiceContract
{
    /**
     * @api
     */
    public ServiceRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ServiceRawService($client);
    }

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
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getServerTime(requestOptions: $requestOptions);

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
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->healthCheck(requestOptions: $requestOptions);

        return $response->parse();
    }
}
