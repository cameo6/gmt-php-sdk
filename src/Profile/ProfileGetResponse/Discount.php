<?php

declare(strict_types=1);

namespace Gmt\Profile\ProfileGetResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Profile\ProfileGetResponse\Discount\Level;

/**
 * @phpstan-type DiscountShape = array{level: value-of<Level>, percent: float}
 */
final class Discount implements BaseModel
{
    /** @use SdkModel<DiscountShape> */
    use SdkModel;

    /**
     * Current discount level: none, bronze, silver, gold, platinum, premium.
     *
     * @var value-of<Level> $level
     */
    #[Required(enum: Level::class)]
    public string $level;

    /**
     * Discount percentage.
     */
    #[Required]
    public float $percent;

    /**
     * `new Discount()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Discount::with(level: ..., percent: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Discount)->withLevel(...)->withPercent(...)
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
     * @param Level|value-of<Level> $level
     */
    public static function with(Level|string $level, float $percent): self
    {
        $obj = new self;

        $obj['level'] = $level;
        $obj['percent'] = $percent;

        return $obj;
    }

    /**
     * Current discount level: none, bronze, silver, gold, platinum, premium.
     *
     * @param Level|value-of<Level> $level
     */
    public function withLevel(Level|string $level): self
    {
        $obj = clone $this;
        $obj['level'] = $level;

        return $obj;
    }

    /**
     * Discount percentage.
     */
    public function withPercent(float $percent): self
    {
        $obj = clone $this;
        $obj['percent'] = $percent;

        return $obj;
    }
}
