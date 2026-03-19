<?php

declare(strict_types=1);

namespace Gmt\Services\Profile;

use Gmt\Client;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\Profile\Discount\DiscountGetResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\Profile\DiscountRawContract;

/**
 * User profile management.
 *
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class DiscountRawService implements DiscountRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns user's current discount level and percentage based on their purchase history.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DiscountGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/profile/discount',
            options: $requestOptions,
            convert: DiscountGetResponse::class,
        );
    }
}
