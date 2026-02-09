<?php

declare(strict_types=1);

namespace Gmt\Profile;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProfileChangePasswordResponseShape = array{success: bool}
 */
final class ProfileChangePasswordResponse implements BaseModel
{
    /** @use SdkModel<ProfileChangePasswordResponseShape> */
    use SdkModel;

    /**
     * Indicates if the operation was successful.
     */
    #[Required]
    public bool $success;

    /**
     * `new ProfileChangePasswordResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProfileChangePasswordResponse::with(success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProfileChangePasswordResponse)->withSuccess(...)
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
    public static function with(bool $success): self
    {
        $self = new self;

        $self['success'] = $success;

        return $self;
    }

    /**
     * Indicates if the operation was successful.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }
}
