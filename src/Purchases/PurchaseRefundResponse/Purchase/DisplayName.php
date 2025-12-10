<?php

declare(strict_types=1);

namespace Gmt\Purchases\PurchaseRefundResponse\Purchase;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type DisplayNameShape = array{en: string, ru: string}
 */
final class DisplayName implements BaseModel
{
    /** @use SdkModel<DisplayNameShape> */
    use SdkModel;

    /**
     * Name in English.
     */
    #[Required]
    public string $en;

    /**
     * Name in Russian.
     */
    #[Required]
    public string $ru;

    /**
     * `new DisplayName()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DisplayName::with(en: ..., ru: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DisplayName)->withEn(...)->withRu(...)
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
    public static function with(string $en, string $ru): self
    {
        $self = new self;

        $self['en'] = $en;
        $self['ru'] = $ru;

        return $self;
    }

    /**
     * Name in English.
     */
    public function withEn(string $en): self
    {
        $self = clone $this;
        $self['en'] = $en;

        return $self;
    }

    /**
     * Name in Russian.
     */
    public function withRu(string $ru): self
    {
        $self = clone $this;
        $self['ru'] = $ru;

        return $self;
    }
}
