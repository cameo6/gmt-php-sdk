<?php

declare(strict_types=1);

namespace Gmt\Profile\Discount\DiscountGetResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type LevelShape = array{name: string, percent: float, purchases: int}
 */
final class Level implements BaseModel
{
    /** @use SdkModel<LevelShape> */
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
     * Required purchases to reach this level.
     */
    #[Required]
    public int $purchases;

    /**
     * `new Level()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Level::with(name: ..., percent: ..., purchases: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Level)->withName(...)->withPercent(...)->withPurchases(...)
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
        int $purchases
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['percent'] = $percent;
        $self['purchases'] = $purchases;

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
     * Required purchases to reach this level.
     */
    public function withPurchases(int $purchases): self
    {
        $self = clone $this;
        $self['purchases'] = $purchases;

        return $self;
    }
}
