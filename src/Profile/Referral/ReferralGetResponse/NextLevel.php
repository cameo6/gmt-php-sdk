<?php

declare(strict_types=1);

namespace Gmt\Profile\Referral\ReferralGetResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Profile\Referral\ReferralGetResponse\NextLevel\Requirements;

/**
 * Next level information. Null if already at max level.
 *
 * @phpstan-import-type RequirementsShape from \Gmt\Profile\Referral\ReferralGetResponse\NextLevel\Requirements
 *
 * @phpstan-type NextLevelShape = array{
 *   name: string, percent: float, requirements: Requirements|RequirementsShape
 * }
 */
final class NextLevel implements BaseModel
{
    /** @use SdkModel<NextLevelShape> */
    use SdkModel;

    /**
     * Name of the next referral level.
     */
    #[Required]
    public string $name;

    /**
     * Commission percentage for the next level.
     */
    #[Required]
    public float $percent;

    #[Required]
    public Requirements $requirements;

    /**
     * `new NextLevel()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NextLevel::with(name: ..., percent: ..., requirements: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NextLevel)->withName(...)->withPercent(...)->withRequirements(...)
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
     *
     * @param Requirements|RequirementsShape $requirements
     */
    public static function with(
        string $name,
        float $percent,
        Requirements|array $requirements
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['percent'] = $percent;
        $self['requirements'] = $requirements;

        return $self;
    }

    /**
     * Name of the next referral level.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Commission percentage for the next level.
     */
    public function withPercent(float $percent): self
    {
        $self = clone $this;
        $self['percent'] = $percent;

        return $self;
    }

    /**
     * @param Requirements|RequirementsShape $requirements
     */
    public function withRequirements(Requirements|array $requirements): self
    {
        $self = clone $this;
        $self['requirements'] = $requirements;

        return $self;
    }
}
