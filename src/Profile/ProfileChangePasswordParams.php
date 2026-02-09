<?php

declare(strict_types=1);

namespace Gmt\Profile;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

/**
 * Change the current user password to a new one.
 *
 * @see Gmt\Services\ProfileService::changePassword()
 *
 * @phpstan-type ProfileChangePasswordParamsShape = array{newPassword: string}
 */
final class ProfileChangePasswordParams implements BaseModel
{
    /** @use SdkModel<ProfileChangePasswordParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * User password. Must contain at least two character types: lowercase, uppercase, digits, or special characters.
     */
    #[Required('new_password')]
    public string $newPassword;

    /**
     * `new ProfileChangePasswordParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProfileChangePasswordParams::with(newPassword: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProfileChangePasswordParams)->withNewPassword(...)
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
    public static function with(string $newPassword): self
    {
        $self = new self;

        $self['newPassword'] = $newPassword;

        return $self;
    }

    /**
     * User password. Must contain at least two character types: lowercase, uppercase, digits, or special characters.
     */
    public function withNewPassword(string $newPassword): self
    {
        $self = clone $this;
        $self['newPassword'] = $newPassword;

        return $self;
    }
}
