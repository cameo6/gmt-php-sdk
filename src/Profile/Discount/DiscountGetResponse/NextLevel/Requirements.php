<?php

declare(strict_types=1);

namespace Gmt\Profile\Discount\DiscountGetResponse\NextLevel;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type RequirementsShape = array{purchases: int}
 */
final class Requirements implements BaseModel
{
    /** @use SdkModel<RequirementsShape> */
    use SdkModel;

    /**
     * Required number of purchases to reach this level.
     */
    #[Required]
    public int $purchases;

    /**
     * `new Requirements()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Requirements::with(purchases: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Requirements)->withPurchases(...)
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
    public static function with(int $purchases): self
    {
        $self = new self;

        $self['purchases'] = $purchases;

        return $self;
    }

    /**
     * Required number of purchases to reach this level.
     */
    public function withPurchases(int $purchases): self
    {
        $self = clone $this;
        $self['purchases'] = $purchases;

        return $self;
    }
}
