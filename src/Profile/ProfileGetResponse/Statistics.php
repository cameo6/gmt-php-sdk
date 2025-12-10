<?php

declare(strict_types=1);

namespace Gmt\Profile\ProfileGetResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type StatisticsShape = array{totalPurchases: int}
 */
final class Statistics implements BaseModel
{
    /** @use SdkModel<StatisticsShape> */
    use SdkModel;

    /**
     * Total number of successful purchases.
     */
    #[Required('total_purchases')]
    public int $totalPurchases;

    /**
     * `new Statistics()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Statistics::with(totalPurchases: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Statistics)->withTotalPurchases(...)
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
    public static function with(int $totalPurchases): self
    {
        $self = new self;

        $self['totalPurchases'] = $totalPurchases;

        return $self;
    }

    /**
     * Total number of successful purchases.
     */
    public function withTotalPurchases(int $totalPurchases): self
    {
        $self = clone $this;
        $self['totalPurchases'] = $totalPurchases;

        return $self;
    }
}
