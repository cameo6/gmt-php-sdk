<?php

declare(strict_types=1);

namespace Gmt\Services\Profile\Referral;

use Gmt\Client;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\Core\Util;
use Gmt\PageNumber;
use Gmt\Profile\Referral\Transaction\TransactionListParams;
use Gmt\Profile\Referral\Transaction\TransactionListResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\Profile\Referral\TransactionRawContract;

/**
 * User profile management.
 *
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class TransactionRawService implements TransactionRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns paginated referral transaction history for the authenticated user, ordered by newest first.
     *
     * @param array{page: int, pageSize: int}|TransactionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PageNumber<TransactionListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|TransactionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TransactionListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/profile/referral/transaction',
            query: Util::array_transform_keys($parsed, ['pageSize' => 'page_size']),
            options: $options,
            convert: TransactionListResponse::class,
            page: PageNumber::class,
        );
    }
}
