<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\Profile\ProfileGetResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\ProfileRawContract;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class ProfileRawService implements ProfileRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns detailed user profile information including balances, statistics, and program levels.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProfileGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/profile/',
            options: $requestOptions,
            convert: ProfileGetResponse::class,
        );
    }
}
