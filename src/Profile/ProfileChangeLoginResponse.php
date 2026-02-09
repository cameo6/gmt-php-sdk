<?php

declare(strict_types=1);

namespace Gmt\Profile;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type ProfileChangeLoginResponseShape = array{success: bool}
 */
final class ProfileChangeLoginResponse implements BaseModel
{
    /** @use SdkModel<ProfileChangeLoginResponseShape> */
    use SdkModel;

    /**
     * Indicates if the operation was successful.
     */
    #[Required]
    public bool $success;

    /**
     * `new ProfileChangeLoginResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProfileChangeLoginResponse::with(success: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProfileChangeLoginResponse)->withSuccess(...)
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
