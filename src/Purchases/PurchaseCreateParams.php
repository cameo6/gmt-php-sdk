<?php

declare(strict_types=1);

namespace Gmt\Purchases;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Concerns\SdkParams;
use Gmt\Core\Contracts\BaseModel;

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
 * @see Gmt\Services\PurchasesService::create()
 *
 * @phpstan-type PurchaseCreateParamsShape = array{countryCode: string}
 */
final class PurchaseCreateParams implements BaseModel
{
    /** @use SdkModel<PurchaseCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * ISO 3166-1 alpha-2 country code.
     */
    #[Required('country_code')]
    public string $countryCode;

    /**
     * `new PurchaseCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchaseCreateParams::with(countryCode: ...)
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
    public static function with(string $countryCode): self
    {
        $obj = new self;

        $obj['countryCode'] = $countryCode;

        return $obj;
    }

    /**
     * ISO 3166-1 alpha-2 country code.
     */
    public function withCountryCode(string $countryCode): self
    {
        $obj = clone $this;
        $obj['countryCode'] = $countryCode;

        return $obj;
    }
}
