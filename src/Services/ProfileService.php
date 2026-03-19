<?php

declare(strict_types=1);

namespace Gmt\Services;

use Gmt\Client;
use Gmt\Core\Exceptions\APIException;
use Gmt\Core\Util;
use Gmt\Profile\ProfileChangeLoginResponse;
use Gmt\Profile\ProfileChangePasswordResponse;
use Gmt\Profile\ProfileGetResponse;
use Gmt\Profile\ProfileUnbindTelegramResponse;
use Gmt\RequestOptions;
use Gmt\ServiceContracts\ProfileContract;
use Gmt\Services\Profile\DiscountService;
use Gmt\Services\Profile\ReferralService;

/**
 * User profile management.
 *
 * @phpstan-import-type RequestOpts from \Gmt\RequestOptions
 */
final class ProfileService implements ProfileContract
{
    /**
     * @api
     */
    public ProfileRawService $raw;

    /**
     * @api
     */
    public DiscountService $discount;

    /**
     * @api
     */
    public ReferralService $referral;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ProfileRawService($client);
        $this->discount = new DiscountService($client);
        $this->referral = new ReferralService($client);
    }

    /**
     * @api
     *
     * Returns detailed user profile information including balances, statistics, and program levels.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): ProfileGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Change the current user login to a new one.
     *
     * @param string $newLogin User login for registration
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function changeLogin(
        string $newLogin,
        RequestOptions|array|null $requestOptions = null
    ): ProfileChangeLoginResponse {
        $params = Util::removeNulls(['newLogin' => $newLogin]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->changeLogin(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Change the current user password to a new one.
     *
     * @param string $newPassword User password. Must contain at least two character types: lowercase, uppercase, digits, or special characters
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function changePassword(
        string $newPassword,
        RequestOptions|array|null $requestOptions = null
    ): ProfileChangePasswordResponse {
        $params = Util::removeNulls(['newPassword' => $newPassword]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->changePassword(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Disables linking of the Telegram account to the user's web profile, all data remains on the web account.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function unbindTelegram(
        RequestOptions|array|null $requestOptions = null
    ): ProfileUnbindTelegramResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->unbindTelegram(requestOptions: $requestOptions);

        return $response->parse();
    }
}
