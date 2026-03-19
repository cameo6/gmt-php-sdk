<?php

declare(strict_types=1);

namespace Gmt\Profile\Referral;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Profile\Referral\ReferralTransferBalanceResponse\Balance;
use Gmt\Profile\Referral\ReferralTransferBalanceResponse\ReferralInfo;

/**
 * @phpstan-import-type BalanceShape from \Gmt\Profile\Referral\ReferralTransferBalanceResponse\Balance
 * @phpstan-import-type ReferralInfoShape from \Gmt\Profile\Referral\ReferralTransferBalanceResponse\ReferralInfo
 *
 * @phpstan-type ReferralTransferBalanceResponseShape = array{
 *   balance: Balance|BalanceShape, referralInfo: ReferralInfo|ReferralInfoShape
 * }
 */
final class ReferralTransferBalanceResponse implements BaseModel
{
    /** @use SdkModel<ReferralTransferBalanceResponseShape> */
    use SdkModel;

    #[Required]
    public Balance $balance;

    #[Required('referral_info')]
    public ReferralInfo $referralInfo;

    /**
     * `new ReferralTransferBalanceResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReferralTransferBalanceResponse::with(balance: ..., referralInfo: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReferralTransferBalanceResponse)->withBalance(...)->withReferralInfo(...)
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
     * @param Balance|BalanceShape $balance
     * @param ReferralInfo|ReferralInfoShape $referralInfo
     */
    public static function with(
        Balance|array $balance,
        ReferralInfo|array $referralInfo
    ): self {
        $self = new self;

        $self['balance'] = $balance;
        $self['referralInfo'] = $referralInfo;

        return $self;
    }

    /**
     * @param Balance|BalanceShape $balance
     */
    public function withBalance(Balance|array $balance): self
    {
        $self = clone $this;
        $self['balance'] = $balance;

        return $self;
    }

    /**
     * @param ReferralInfo|ReferralInfoShape $referralInfo
     */
    public function withReferralInfo(ReferralInfo|array $referralInfo): self
    {
        $self = clone $this;
        $self['referralInfo'] = $referralInfo;

        return $self;
    }
}
