<?php

declare(strict_types=1);

namespace Gmt\Profile\ProfileGetResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * @phpstan-type BalanceShape = array{amount: string, currencyCode: string}
 */
final class Balance implements BaseModel
{
    /** @use SdkModel<BalanceShape> */
    use SdkModel;

    /**
     * Monetary amount as a string with up to 2 decimal places.
     */
    #[Required]
    public string $amount;

    /**
     * ISO 4217 currency code.
     */
    #[Required('currency_code')]
    public string $currencyCode;

    /**
     * `new Balance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Balance::with(amount: ..., currencyCode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Balance)->withAmount(...)->withCurrencyCode(...)
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
    public static function with(string $amount, string $currencyCode): self
    {
        $obj = new self;

        $obj['amount'] = $amount;
        $obj['currencyCode'] = $currencyCode;

        return $obj;
    }

    /**
     * Monetary amount as a string with up to 2 decimal places.
     */
    public function withAmount(string $amount): self
    {
        $obj = clone $this;
        $obj['amount'] = $amount;

        return $obj;
    }

    /**
     * ISO 4217 currency code.
     */
    public function withCurrencyCode(string $currencyCode): self
    {
        $obj = clone $this;
        $obj['currencyCode'] = $currencyCode;

        return $obj;
    }
}
