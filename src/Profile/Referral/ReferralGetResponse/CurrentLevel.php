<?php

declare(strict_types=1);

namespace Gmt\Profile\Referral\ReferralGetResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Profile\Referral\ReferralGetResponse\CurrentLevel\Name;
use Gmt\Profile\Referral\ReferralGetResponse\CurrentLevel\Progress;

/**
 * @phpstan-import-type ProgressShape from \Gmt\Profile\Referral\ReferralGetResponse\CurrentLevel\Progress
 *
 * @phpstan-type CurrentLevelShape = array{
 *   name: Name|value-of<Name>, percent: float, progress: Progress|ProgressShape
 * }
 */
final class CurrentLevel implements BaseModel
{
    /** @use SdkModel<CurrentLevelShape> */
    use SdkModel;

    /**
     * Name of the current referral level.
     *
     * @var value-of<Name> $name
     */
    #[Required(enum: Name::class)]
    public string $name;

    /**
     * Commission percentage.
     */
    #[Required]
    public float $percent;

    #[Required]
    public Progress $progress;

    /**
     * `new CurrentLevel()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CurrentLevel::with(name: ..., percent: ..., progress: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CurrentLevel)->withName(...)->withPercent(...)->withProgress(...)
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
     * @param Name|value-of<Name> $name
     * @param Progress|ProgressShape $progress
     */
    public static function with(
        Name|string $name,
        float $percent,
        Progress|array $progress
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['percent'] = $percent;
        $self['progress'] = $progress;

        return $self;
    }

    /**
     * Name of the current referral level.
     *
     * @param Name|value-of<Name> $name
     */
    public function withName(Name|string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Commission percentage.
     */
    public function withPercent(float $percent): self
    {
        $self = clone $this;
        $self['percent'] = $percent;

        return $self;
    }

    /**
     * @param Progress|ProgressShape $progress
     */
    public function withProgress(Progress|array $progress): self
    {
        $self = clone $this;
        $self['progress'] = $progress;

        return $self;
    }
}
