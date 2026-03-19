<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts\Profile\Referral;

use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\PageNumber;
use Gmt\Profile\Referral\Transaction\TransactionListParams;
use Gmt\Profile\Referral\Transaction\TransactionListResponse;
use Gmt\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface TransactionRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|TransactionListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PageNumber<TransactionListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|TransactionListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
