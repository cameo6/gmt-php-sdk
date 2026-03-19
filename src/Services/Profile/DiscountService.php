<?php

declare(strict_types=1);

namespace Gmt\Services\Profile;

use Gmt\Client;
use Gmt\Core\Exceptions\APIException;
use Gmt\Profile\Discount\DiscountGetResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\Profile\DiscountContract;

/**
 * User profile management.
 *
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class DiscountService implements DiscountContract
{
    /**
     * @api
     */
    public DiscountRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DiscountRawService($client);
    }

    /**
     * @api
     *
     * Returns user's current discount level and percentage based on their purchase history.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): DiscountGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(requestOptions: $requestOptions);

        return $response->parse();
    }
}
