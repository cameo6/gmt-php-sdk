<?php

declare(strict_types=1);

namespace Gmt\PurchasesByHash;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\PurchasesByHash\PurchasesByHashRequestVerificationCodeResponse\CodeRequest;
use Gmt\PurchasesByHash\PurchasesByHashRequestVerificationCodeResponse\Purchase;

/**
 * @phpstan-import-type CodeRequestShape from \Gmt\PurchasesByHash\PurchasesByHashRequestVerificationCodeResponse\CodeRequest
 * @phpstan-import-type PurchaseShape from \Gmt\PurchasesByHash\PurchasesByHashRequestVerificationCodeResponse\Purchase
 *
 * @phpstan-type PurchasesByHashRequestVerificationCodeResponseShape = array{
 *   codeRequest: CodeRequest|CodeRequestShape, purchase: Purchase|PurchaseShape
 * }
 */
final class PurchasesByHashRequestVerificationCodeResponse implements BaseModel
{
    /** @use SdkModel<PurchasesByHashRequestVerificationCodeResponseShape> */
    use SdkModel;

    #[Required('code_request')]
    public CodeRequest $codeRequest;

    #[Required]
    public Purchase $purchase;

    /**
     * `new PurchasesByHashRequestVerificationCodeResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PurchasesByHashRequestVerificationCodeResponse::with(
     *   codeRequest: ..., purchase: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PurchasesByHashRequestVerificationCodeResponse)
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
     * @param CodeRequest|CodeRequestShape $codeRequest
     * @param Purchase|PurchaseShape $purchase
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
     * @param CodeRequest|CodeRequestShape $codeRequest
     */
    public function withCodeRequest(CodeRequest|array $codeRequest): self
    {
        $self = clone $this;
        $self['codeRequest'] = $codeRequest;

        return $self;
    }

    /**
     * @param Purchase|PurchaseShape $purchase
     */
    public function withPurchase(Purchase|array $purchase): self
    {
        $self = clone $this;
        $self['purchase'] = $purchase;

        return $self;
    }
}
