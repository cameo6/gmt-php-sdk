<?php

declare(strict_types=1);

namespace Gmt\Profile\Discount;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Profile\Discount\DiscountGetResponse\CurrentLevel;
use Gmt\Profile\Discount\DiscountGetResponse\CustomDiscount;
use Gmt\Profile\Discount\DiscountGetResponse\Level;
use Gmt\Profile\Discount\DiscountGetResponse\NextLevel;

/**
 * @phpstan-import-type CurrentLevelShape from \Gmt\Profile\Discount\DiscountGetResponse\CurrentLevel
 * @phpstan-import-type CustomDiscountShape from \Gmt\Profile\Discount\DiscountGetResponse\CustomDiscount
 * @phpstan-import-type LevelShape from \Gmt\Profile\Discount\DiscountGetResponse\Level
 * @phpstan-import-type NextLevelShape from \Gmt\Profile\Discount\DiscountGetResponse\NextLevel
 *
 * @phpstan-type DiscountGetResponseShape = array{
 *   currentLevel: CurrentLevel|CurrentLevelShape,
 *   customDiscounts: list<CustomDiscount|CustomDiscountShape>,
 *   levels: list<Level|LevelShape>,
 *   nextLevel: null|NextLevel|NextLevelShape,
 * }
 */
final class DiscountGetResponse implements BaseModel
{
    /** @use SdkModel<DiscountGetResponseShape> */
    use SdkModel;

    #[Required('current_level')]
    public CurrentLevel $currentLevel;

    /**
     * Personal discount rules.
     *
     * @var list<CustomDiscount> $customDiscounts
     */
    #[Required('custom_discounts', list: CustomDiscount::class)]
    public array $customDiscounts;

    /**
     * All available discount levels.
     *
     * @var list<Level> $levels
     */
    #[Required(list: Level::class)]
    public array $levels;

    /**
     * Next level information. Null if already at max level.
     */
    #[Required('next_level')]
    public ?NextLevel $nextLevel;

    /**
     * `new DiscountGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DiscountGetResponse::with(
     *   currentLevel: ..., customDiscounts: ..., levels: ..., nextLevel: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DiscountGetResponse)
     *   ->withCurrentLevel(...)
     *   ->withCustomDiscounts(...)
     *   ->withLevels(...)
     *   ->withNextLevel(...)
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
     * @param CurrentLevel|CurrentLevelShape $currentLevel
     * @param list<CustomDiscount|CustomDiscountShape> $customDiscounts
     * @param list<Level|LevelShape> $levels
     * @param NextLevel|NextLevelShape|null $nextLevel
     */
    public static function with(
        CurrentLevel|array $currentLevel,
        array $customDiscounts,
        array $levels,
        NextLevel|array|null $nextLevel,
    ): self {
        $self = new self;

        $self['currentLevel'] = $currentLevel;
        $self['customDiscounts'] = $customDiscounts;
        $self['levels'] = $levels;
        $self['nextLevel'] = $nextLevel;

        return $self;
    }

    /**
     * @param CurrentLevel|CurrentLevelShape $currentLevel
     */
    public function withCurrentLevel(CurrentLevel|array $currentLevel): self
    {
        $self = clone $this;
        $self['currentLevel'] = $currentLevel;

        return $self;
    }

    /**
     * Personal discount rules.
     *
     * @param list<CustomDiscount|CustomDiscountShape> $customDiscounts
     */
    public function withCustomDiscounts(array $customDiscounts): self
    {
        $self = clone $this;
        $self['customDiscounts'] = $customDiscounts;

        return $self;
    }

    /**
     * All available discount levels.
     *
     * @param list<Level|LevelShape> $levels
     */
    public function withLevels(array $levels): self
    {
        $self = clone $this;
        $self['levels'] = $levels;

        return $self;
    }

    /**
     * Next level information. Null if already at max level.
     *
     * @param NextLevel|NextLevelShape|null $nextLevel
     */
    public function withNextLevel(NextLevel|array|null $nextLevel): self
    {
        $self = clone $this;
        $self['nextLevel'] = $nextLevel;

        return $self;
    }
}
