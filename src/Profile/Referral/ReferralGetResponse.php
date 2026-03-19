<?php

declare(strict_types=1);

namespace Gmt\Profile\Referral;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Profile\Referral\ReferralGetResponse\CurrentLevel;
use Gmt\Profile\Referral\ReferralGetResponse\Level;
use Gmt\Profile\Referral\ReferralGetResponse\NextLevel;
use Gmt\Profile\Referral\ReferralGetResponse\ReferralInfo;

/**
 * @phpstan-import-type CurrentLevelShape from \Gmt\Profile\Referral\ReferralGetResponse\CurrentLevel
 * @phpstan-import-type LevelShape from \Gmt\Profile\Referral\ReferralGetResponse\Level
 * @phpstan-import-type NextLevelShape from \Gmt\Profile\Referral\ReferralGetResponse\NextLevel
 * @phpstan-import-type ReferralInfoShape from \Gmt\Profile\Referral\ReferralGetResponse\ReferralInfo
 *
 * @phpstan-type ReferralGetResponseShape = array{
 *   currentLevel: CurrentLevel|CurrentLevelShape,
 *   levels: list<Level|LevelShape>,
 *   nextLevel: null|NextLevel|NextLevelShape,
 *   referralInfo: ReferralInfo|ReferralInfoShape,
 *   referralLink: string,
 * }
 */
final class ReferralGetResponse implements BaseModel
{
    /** @use SdkModel<ReferralGetResponseShape> */
    use SdkModel;

    #[Required('current_level')]
    public CurrentLevel $currentLevel;

    /**
     * All available referral levels.
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

    #[Required('referral_info')]
    public ReferralInfo $referralInfo;

    /**
     * User's referral link.
     */
    #[Required('referral_link')]
    public string $referralLink;

    /**
     * `new ReferralGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReferralGetResponse::with(
     *   currentLevel: ...,
     *   levels: ...,
     *   nextLevel: ...,
     *   referralInfo: ...,
     *   referralLink: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReferralGetResponse)
     *   ->withCurrentLevel(...)
     *   ->withLevels(...)
     *   ->withNextLevel(...)
     *   ->withReferralInfo(...)
     *   ->withReferralLink(...)
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
     * @param list<Level|LevelShape> $levels
     * @param NextLevel|NextLevelShape|null $nextLevel
     * @param ReferralInfo|ReferralInfoShape $referralInfo
     */
    public static function with(
        CurrentLevel|array $currentLevel,
        array $levels,
        NextLevel|array|null $nextLevel,
        ReferralInfo|array $referralInfo,
        string $referralLink,
    ): self {
        $self = new self;

        $self['currentLevel'] = $currentLevel;
        $self['levels'] = $levels;
        $self['nextLevel'] = $nextLevel;
        $self['referralInfo'] = $referralInfo;
        $self['referralLink'] = $referralLink;

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
     * All available referral levels.
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

    /**
     * @param ReferralInfo|ReferralInfoShape $referralInfo
     */
    public function withReferralInfo(ReferralInfo|array $referralInfo): self
    {
        $self = clone $this;
        $self['referralInfo'] = $referralInfo;

        return $self;
    }

    /**
     * User's referral link.
     */
    public function withReferralLink(string $referralLink): self
    {
        $self = clone $this;
        $self['referralLink'] = $referralLink;

        return $self;
    }
}
