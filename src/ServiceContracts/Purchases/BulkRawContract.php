<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts\Purchases;

use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\Purchases\Bulk\BulkCreateParams;
use Gmt\Purchases\Bulk\BulkGetResponse;
use Gmt\Purchases\Bulk\BulkNewResponse;
use Gmt\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface BulkRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|BulkCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BulkNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|BulkCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BulkGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $purchaseID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function download(
        string $purchaseID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
