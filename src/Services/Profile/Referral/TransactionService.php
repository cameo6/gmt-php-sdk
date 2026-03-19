<?php

declare(strict_types=1);

namespace Gmt\Services\Profile\Referral;

use Gmt\Client;
use Gmt\Core\Exceptions\APIException;
use Gmt\Core\Util;
use Gmt\PageNumber;
use Gmt\Profile\Referral\Transaction\TransactionListResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\Profile\Referral\TransactionContract;

/**
 * User profile management.
 *
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class TransactionService implements TransactionContract
{
    /**
     * @api
     */
    public TransactionRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TransactionRawService($client);
    }

    /**
     * @api
     *
     * Returns paginated referral transaction history for the authenticated user, ordered by newest first.
     *
     * @param int $page page number
     * @param int $pageSize number of items per page
     * @param RequestOpts|null $requestOptions
     *
     * @return PageNumber<TransactionListResponse>
     *
     * @throws APIException
     */
    public function list(
        int $page = 1,
        int $pageSize = 50,
        RequestOptions|array|null $requestOptions = null,
    ): PageNumber {
        $params = Util::removeNulls(['page' => $page, 'pageSize' => $pageSize]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
