<?php

declare(strict_types=1);

namespace Gmt\ServiceContracts;

use Gmt\Core\Exceptions\APIException;
use Gmt\Profile\ProfileChangeLanguageParams\Language;
use Gmt\Profile\ProfileChangeLanguageResponse;
use Gmt\Profile\ProfileChangeLoginResponse;
use Gmt\Profile\ProfileChangePasswordResponse;
use Gmt\Profile\ProfileGetResponse;
use Gmt\Profile\ProfileUnbindTelegramResponse;
use Gmt\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
interface ProfileContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): ProfileGetResponse;

    /**
     * @api
     *
     * @param Language|value-of<Language> $language Preferred user interface language
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function changeLanguage(
        Language|string $language,
        RequestOptions|array|null $requestOptions = null,
    ): ProfileChangeLanguageResponse;

    /**
     * @api
     *
     * @param string $newLogin User login for registration
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function changeLogin(
        string $newLogin,
        RequestOptions|array|null $requestOptions = null
    ): ProfileChangeLoginResponse;

    /**
     * @api
     *
     * @param string $newPassword User password. Must contain at least two character types: lowercase, uppercase, digits, or special characters
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function changePassword(
        string $newPassword,
        RequestOptions|array|null $requestOptions = null
    ): ProfileChangePasswordResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function unbindTelegram(
        RequestOptions|array|null $requestOptions = null
    ): ProfileUnbindTelegramResponse;
}
