<?php

declare(strict_types=1);

namespace Gmt\Profile\Discount\DiscountGetResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Profile\Discount\DiscountGetResponse\NextLevel\Progress;
use Gmt\Profile\Discount\DiscountGetResponse\NextLevel\Requirements;

/**
 * Next level information. Null if already at max level.
 *
 * @phpstan-import-type ProgressShape from \Gmt\Profile\Discount\DiscountGetResponse\NextLevel\Progress
 * @phpstan-import-type RequirementsShape from \Gmt\Profile\Discount\DiscountGetResponse\NextLevel\Requirements
 *
 * @phpstan-type NextLevelShape = array{
 *   name: string,
 *   percent: float,
 *   progress: Progress|ProgressShape,
 *   requirements: Requirements|RequirementsShape,
 * }
 */
final class NextLevel implements BaseModel
{
    /** @use SdkModel<NextLevelShape> */
    use SdkModel;

    /**
     * Name of the next discount level.
     */
    #[Required]
    public string $name;

    /**
     * Discount percentage for the next level.
     */
    #[Required]
    public float $percent;

    #[Required]
    public Progress $progress;

    #[Required]
    public Requirements $requirements;

    /**
     * `new NextLevel()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NextLevel::with(name: ..., percent: ..., progress: ..., requirements: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NextLevel)
     *   ->withName(...)
     *   ->withPercent(...)
     *   ->withProgress(...)
     *   ->withRequirements(...)
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
     * @param Progress|ProgressShape $progress
     * @param Requirements|RequirementsShape $requirements
     */
    public static function with(
        string $name,
        float $percent,
        Progress|array $progress,
        Requirements|array $requirements,
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['percent'] = $percent;
        $self['progress'] = $progress;
        $self['requirements'] = $requirements;

        return $self;
    }

    /**
     * Name of the next discount level.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Discount percentage for the next level.
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
