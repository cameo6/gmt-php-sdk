<?php

declare(strict_types=1);

namespace GmtPhpSDK\Services;

use GmtPhpSDK\Client;
use GmtPhpSDK\Core\Exceptions\APIException;
use GmtPhpSDK\Profile\ProfileGetResponse;
use GmtPhpSDK\RequestOptions;
use GmtPhpSDK\ServiceContracts\ProfileContract;

final class ProfileService implements ProfileContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns detailed user profile information including balances, statistics, and program levels.
     *
     * @throws APIException
     */
    public function retrieve(
        ?RequestOptions $requestOptions = null
    ): ProfileGetResponse {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'v1/profile/',
            options: $requestOptions,
            convert: ProfileGetResponse::class,
        );
    }
}
