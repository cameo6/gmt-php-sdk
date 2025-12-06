<?php

declare(strict_types=1);

namespace Gmt\Purchases\PurchaseNewResponse;

use Gmt\Core\Attributes\Api;
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
    #[Api]
    public string $en;

    /**
     * Name in Russian.
     */
    #[Api]
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
        $obj = new self;

        $obj['en'] = $en;
        $obj['ru'] = $ru;

        return $obj;
    }

    /**
     * Name in English.
     */
    public function withEn(string $en): self
    {
        $obj = clone $this;
        $obj['en'] = $en;

        return $obj;
    }

    /**
     * Name in Russian.
     */
    public function withRu(string $ru): self
    {
        $obj = clone $this;
        $obj['ru'] = $ru;

        return $obj;
    }
}
