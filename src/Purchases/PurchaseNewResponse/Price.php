<?php

declare(strict_types=1);

namespace GmtPhpSDK\Purchases\PurchaseNewResponse;

use GmtPhpSDK\Core\Attributes\Api;
use GmtPhpSDK\Core\Concerns\SdkModel;
use GmtPhpSDK\Core\Contracts\BaseModel;

/**
 * **Final Price After Discount.** The actual amount deducted from your balance, with your personal discount already applied.
 *
 * **To see pricing breakdown before purchase.** Check `GET /accounts/:country_code` which shows both discounted price and original `base_price`.
 *
 * **Discount eligibility.** Based on your total successful purchase count. Higher volume = bigger discounts.
 *
 * @phpstan-type PriceShape = array{amount: string, currency_code: string}
 */
final class Price implements BaseModel
{
    /** @use SdkModel<PriceShape> */
    use SdkModel;

    /**
     * Monetary amount as a string with up to 2 decimal places.
     */
    #[Api]
    public string $amount;

    /**
     * ISO 4217 currency code.
     */
    #[Api]
    public string $currency_code;

    /**
     * `new Price()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Price::with(amount: ..., currency_code: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Price)->withAmount(...)->withCurrencyCode(...)
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
    public static function with(string $amount, string $currency_code): self
    {
        $obj = new self;

        $obj->amount = $amount;
        $obj->currency_code = $currency_code;

        return $obj;
    }

    /**
     * Monetary amount as a string with up to 2 decimal places.
     */
    public function withAmount(string $amount): self
    {
        $obj = clone $this;
        $obj->amount = $amount;

        return $obj;
    }

    /**
     * ISO 4217 currency code.
     */
    public function withCurrencyCode(string $currencyCode): self
    {
        $obj = clone $this;
        $obj->currency_code = $currencyCode;

        return $obj;
    }
}
