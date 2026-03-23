<?php

declare(strict_types=1);

namespace Gmt\Profile\Referral\ReferralGetResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Profile\Referral\ReferralGetResponse\Level\Name;

/**
 * @phpstan-type LevelShape = array{
 *   name: Name|value-of<Name>,
 *   percent: float,
 *   requiredDeposits: float,
 *   requiredReferrals: int,
 * }
 */
final class Level implements BaseModel
{
    /** @use SdkModel<LevelShape> */
    use SdkModel;

    /**
     * Name of the referral level.
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

    /**
     * Required deposits to reach this level.
     */
    #[Required('required_deposits')]
    public float $requiredDeposits;

    /**
     * Required referrals to reach this level.
     */
    #[Required('required_referrals')]
    public int $requiredReferrals;

    /**
     * `new Level()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Level::with(
     *   name: ..., percent: ..., requiredDeposits: ..., requiredReferrals: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Level)
     *   ->withName(...)
     *   ->withPercent(...)
     *   ->withRequiredDeposits(...)
     *   ->withRequiredReferrals(...)
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
     */
    public static function with(
        Name|string $name,
        float $percent,
        float $requiredDeposits,
        int $requiredReferrals,
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['percent'] = $percent;
        $self['requiredDeposits'] = $requiredDeposits;
        $self['requiredReferrals'] = $requiredReferrals;

        return $self;
    }

    /**
     * Name of the referral level.
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
     * Required deposits to reach this level.
     */
    public function withRequiredDeposits(float $requiredDeposits): self
    {
        $self = clone $this;
        $self['requiredDeposits'] = $requiredDeposits;

        return $self;
    }

    /**
     * Required referrals to reach this level.
     */
    public function withRequiredReferrals(int $requiredReferrals): self
    {
        $self = clone $this;
        $self['requiredReferrals'] = $requiredReferrals;

        return $self;
    }
}
