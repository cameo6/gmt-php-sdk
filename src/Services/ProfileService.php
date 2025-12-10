<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\Core\Exceptions\APIException;
use Gmt\Profile\ProfileGetResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\ProfileContract;

final class ProfileService implements ProfileContract
{
    /**
     * @api
     */
    public ProfileRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ProfileRawService($client);
    }

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
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(requestOptions: $requestOptions);

        return $response->parse();
    }
}
