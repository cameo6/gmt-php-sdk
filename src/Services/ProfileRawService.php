<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\Core\Contracts\BaseResponse;
use Gmt\Core\Exceptions\APIException;
use Gmt\Profile\ProfileChangeLoginParams;
use Gmt\Profile\ProfileChangeLoginResponse;
use Gmt\Profile\ProfileChangePasswordParams;
use Gmt\Profile\ProfileChangePasswordResponse;
use Gmt\Profile\ProfileGetResponse;
use Gmt\Profile\ProfileUnbindTelegramResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\ProfileRawContract;

/**
 * User profile management.
 *
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

    /**
     * @api
     *
     * Change the current user login to a new one.
     *
     * @param array{newLogin: string}|ProfileChangeLoginParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProfileChangeLoginResponse>
     *
     * @throws APIException
     */
    public function changeLogin(
        array|ProfileChangeLoginParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProfileChangeLoginParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: 'v1/profile/change-login',
            body: (object) $parsed,
            options: $options,
            convert: ProfileChangeLoginResponse::class,
        );
    }

    /**
     * @api
     *
     * Change the current user password to a new one.
     *
     * @param array{newPassword: string}|ProfileChangePasswordParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProfileChangePasswordResponse>
     *
     * @throws APIException
     */
    public function changePassword(
        array|ProfileChangePasswordParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProfileChangePasswordParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: 'v1/profile/change-password',
            body: (object) $parsed,
            options: $options,
            convert: ProfileChangePasswordResponse::class,
        );
    }

    /**
     * @api
     *
     * Disables linking of the Telegram account to the user's web profile, all data remains on the web account.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProfileUnbindTelegramResponse>
     *
     * @throws APIException
     */
    public function unbindTelegram(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: 'v1/profile/unbind-telegram',
            options: $requestOptions,
            convert: ProfileUnbindTelegramResponse::class,
        );
    }
}
