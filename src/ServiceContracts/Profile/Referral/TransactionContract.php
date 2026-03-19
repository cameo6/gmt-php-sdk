<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts\Profile\Referral;

use Gmt\Core\Exceptions\APIException;
use Gmt\PageNumber;
use Gmt\Profile\Referral\Transaction\TransactionListResponse;
use Gmt\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface TransactionContract
{
    /**
     * @api
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
    ): PageNumber;
}
