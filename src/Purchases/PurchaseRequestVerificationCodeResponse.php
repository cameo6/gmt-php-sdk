<?php

declare(strict_types=1);

namespace Gmt\Purchases;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\CodeRequest;
use Gmt\Purchases\PurchaseRequestVerificationCodeResponse\Purchase;

/**
 * @phpstan-import-type CodeRequestShape from \Gmt\Purchases\PurchaseRequestVerificationCodeResponse\CodeRequest
 * @phpstan-import-type PurchaseShape from \Gmt\Purchases\PurchaseRequestVerificationCodeResponse\Purchase
 *
 * @phpstan-type PurchaseRequestVerificationCodeResponseShape = array{
 *   codeRequest: CodeRequest|CodeRequestShape, purchase: Purchase|PurchaseShape
 * }
 */
final class PurchaseRequestVerificationCodeResponse implements BaseModel
{
    /** @use SdkModel<PurchaseRequestVerificationCodeResponseShape> */
    use SdkModel;

    #[Required('code_request')]
    public CodeRequest $codeRequest;

    #[Required]
    public Purchase $purchase;

    /**
     * `new PurchaseRequestVerificationCodeResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchaseRequestVerificationCodeResponse::with(codeRequest: ..., purchase: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurchaseRequestVerificationCodeResponse)
     *   ->withCodeRequest(...)
     *   ->withPurchase(...)
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
     *
     * @param CodeRequestShape $codeRequest
     * @param PurchaseShape $purchase
     */
    public static function with(
        CodeRequest|array $codeRequest,
        Purchase|array $purchase
    ): self {
        $self = new self;

        $self['codeRequest'] = $codeRequest;
        $self['purchase'] = $purchase;

        return $self;
    }

    /**
     * @param CodeRequestShape $codeRequest
     */
    public function withCodeRequest(CodeRequest|array $codeRequest): self
    {
        $self = clone $this;
        $self['codeRequest'] = $codeRequest;

        return $self;
    }

    /**
     * @param PurchaseShape $purchase
     */
    public function withPurchase(Purchase|array $purchase): self
    {
        $self = clone $this;
        $self['purchase'] = $purchase;

        return $self;
    }
}
