<?php

declare(strict_types=1);

namespace Gmt\Purchases\PurchaseNewResponse;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;

/**
 * **Final Price After Discount.** The actual amount deducted from your balance, with your personal discount already applied.
 *
 * **To see pricing breakdown before purchase.** Check `GET /accounts/:country_code` which shows both discounted price and original `base_price`.
 *
 * **Discount eligibility.** Based on your total successful purchase count. Higher volume = bigger discounts.
 *
 * @phpstan-type PriceShape = array{amount: string, currencyCode: string}
 */
final class Price implements BaseModel
{
    /** @use SdkModel<PriceShape> */
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
     * `new Price()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Price::with(amount: ..., currencyCode: ...)
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
    public static function with(string $amount, string $currencyCode): self
    {
        $self = new self;

        $self['amount'] = $amount;
        $self['currencyCode'] = $currencyCode;

        return $self;
    }

    /**
     * Monetary amount as a string with up to 2 decimal places.
     */
    public function withAmount(string $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * ISO 4217 currency code.
     */
    public function withCurrencyCode(string $currencyCode): self
    {
        $self = clone $this;
        $self['currencyCode'] = $currencyCode;

        return $self;
    }
}
