<?php

declare(strict_types=1);

namespace Gmt\Telegram\Purchases;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

/**
 * Returns paginated history of star purchases for the authenticated user.
 *
 * @see Gmt\Services\Telegram\PurchasesService::listStars()
 *
 * @phpstan-type PurchaseListStarsParamsShape = array{page: int, pageSize: int}
 */
final class PurchaseListStarsParams implements BaseModel
{
    /** @use SdkModel<PurchaseListStarsParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Page number.
     */
    #[Required]
    public int $page;

    /**
     * Number of items per page.
     */
    #[Required]
    public int $pageSize;

    /**
     * `new PurchaseListStarsParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchaseListStarsParams::with(page: ..., pageSize: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurchaseListStarsParams)->withPage(...)->withPageSize(...)
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
    public static function with(int $page = 1, int $pageSize = 50): self
    {
        $self = new self;

        $self['page'] = $page;
        $self['pageSize'] = $pageSize;

        return $self;
    }

    /**
     * Page number.
     */
    public function withPage(int $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

        return $self;
    }

    /**
     * Number of items per page.
     */
    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }
}
