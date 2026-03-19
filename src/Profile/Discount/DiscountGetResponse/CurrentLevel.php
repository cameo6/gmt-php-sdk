<?php

declare(strict_types=1);

namespace Gmt\Profile\Discount\DiscountGetResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type CurrentLevelShape = array{
 *   name: string, percent: float, purchasesRequired: int
 * }
 */
final class CurrentLevel implements BaseModel
{
    /** @use SdkModel<CurrentLevelShape> */
    use SdkModel;

    /**
     * Name of the discount level.
     */
    #[Required]
    public string $name;

    /**
     * Discount percentage.
     */
    #[Required]
    public float $percent;

    /**
     * Required number of purchases to reach this level.
     */
    #[Required('purchases_required')]
    public int $purchasesRequired;

    /**
     * `new CurrentLevel()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CurrentLevel::with(name: ..., percent: ..., purchasesRequired: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CurrentLevel)->withName(...)->withPercent(...)->withPurchasesRequired(...)
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
    public static function with(
        string $name,
        float $percent,
        int $purchasesRequired
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['percent'] = $percent;
        $self['purchasesRequired'] = $purchasesRequired;

        return $self;
    }

    /**
     * Name of the discount level.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Discount percentage.
     */
    public function withPercent(float $percent): self
    {
        $self = clone $this;
        $self['percent'] = $percent;

        return $self;
    }

    /**
     * Required number of purchases to reach this level.
     */
    public function withPurchasesRequired(int $purchasesRequired): self
    {
        $self = clone $this;
        $self['purchasesRequired'] = $purchasesRequired;

        return $self;
    }
}
