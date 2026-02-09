<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\Profile\ProfileChangeLoginParams;
use Gmt\Profile\ProfileChangeLoginResponse;
use Gmt\Profile\ProfileChangePasswordParams;
use Gmt\Profile\ProfileChangePasswordResponse;
use Gmt\Profile\ProfileGetResponse;
use Gmt\Profile\ProfileUnbindTelegramResponse;
use Gmt\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface ProfileRawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProfileGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ProfileChangeLoginParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProfileChangeLoginResponse>
     *
     * @throws APIException
     */
    public function changeLogin(
        array|ProfileChangeLoginParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|ProfileChangePasswordParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProfileChangePasswordResponse>
     *
     * @throws APIException
     */
    public function changePassword(
        array|ProfileChangePasswordParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProfileUnbindTelegramResponse>
     *
     * @throws APIException
     */
    public function unbindTelegram(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
