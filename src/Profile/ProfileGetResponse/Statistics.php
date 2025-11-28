<?php

declare(strict_types=1);

namespace Gmt\Profile\ProfileGetResponse;

use Gmt\Core\Attributes\Api;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type StatisticsShape = array{total_purchases: int}
 */
final class Statistics implements BaseModel
{
    /** @use SdkModel<StatisticsShape> */
    use SdkModel;

    /**
     * Total number of successful purchases.
     */
    #[Api]
    public int $total_purchases;

    /**
     * `new Statistics()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Statistics::with(total_purchases: ...)
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
    public static function with(int $total_purchases): self
    {
        $obj = new self;

        $obj->total_purchases = $total_purchases;

        return $obj;
    }

    /**
     * Total number of successful purchases.
     */
    public function withTotalPurchases(int $totalPurchases): self
    {
        $obj = clone $this;
        $obj->total_purchases = $totalPurchases;

        return $obj;
    }
}
