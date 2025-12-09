<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\Profile\ProfileGetResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\ProfileContract;

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
        /** @var BaseResponse<ProfileGetResponse> */
        $response = $this->client->request(
            method: 'get',
            path: 'v1/profile/',
            options: $requestOptions,
            convert: ProfileGetResponse::class,
        );

        return $response->parse();
    }
}
