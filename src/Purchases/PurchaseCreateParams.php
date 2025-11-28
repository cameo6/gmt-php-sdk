<?php

declare(strict_types=1);

namespace GmtPhpSDK\Purchases;

use GmtPhpSDK\Core\Attributes\Api;
use GmtPhpSDK\Core\Concerns\SdkModel;
use GmtPhpSDK\Core\Concerns\SdkParams;
use GmtPhpSDK\Core\Contracts\BaseModel;

/**
 * Creates a new purchase for specified country. Deducts balance immediately and returns purchase with `PENDING` status.
 *
 * **Purchase Creation Process**
 * 1. Validates country availability and user balance.
 * 2. Reserves account from provider.
 * 3. Atomically deducts balance and creates purchase record.
 * 4. Returns purchase in `PENDING` status.
 *
 * **Next steps.** Call `POST /purchases/:id/request-code` to retrieve login credentials.
 *
 * **Country availability.** Accounts may become unavailable between checking `/accounts` and creating purchase. Always handle availability errors gracefully.
 *
 * @see GmtPhpSDK\Services\PurchasesService::create()
 *
 * @phpstan-type PurchaseCreateParamsShape = array{country_code: string}
 */
final class PurchaseCreateParams implements BaseModel
{
    /** @use SdkModel<PurchaseCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * ISO 3166-1 alpha-2 country code.
     */
    #[Api]
    public string $country_code;

    /**
     * `new PurchaseCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchaseCreateParams::with(country_code: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurchaseCreateParams)->withCountryCode(...)
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
    public static function with(string $country_code): self
    {
        $obj = new self;

        $obj->country_code = $country_code;

        return $obj;
    }

    /**
     * ISO 3166-1 alpha-2 country code.
     */
    public function withCountryCode(string $countryCode): self
    {
        $obj = clone $this;
        $obj->country_code = $countryCode;

        return $obj;
    }
}
