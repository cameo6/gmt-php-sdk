<?php

declare(strict_types=1);

namespace Gmt\Profile;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

/**
 * Change the current user login to a new one.
 *
 * @see Gmt\Services\ProfileService::changeLogin()
 *
 * @phpstan-type ProfileChangeLoginParamsShape = array{newLogin: string}
 */
final class ProfileChangeLoginParams implements BaseModel
{
    /** @use SdkModel<ProfileChangeLoginParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * User login for registration.
     */
    #[Required('new_login')]
    public string $newLogin;

    /**
     * `new ProfileChangeLoginParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProfileChangeLoginParams::with(newLogin: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProfileChangeLoginParams)->withNewLogin(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $newLogin): self
    {
        $self = new self;

        $self['newLogin'] = $newLogin;

        return $self;
    }

    /**
     * User login for registration.
     */
    public function withNewLogin(string $newLogin): self
    {
        $self = clone $this;
        $self['newLogin'] = $newLogin;

        return $self;
    }
}
