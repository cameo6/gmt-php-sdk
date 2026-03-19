<?php

declare(strict_types=1);

namespace Gmt\Profile\Referral\Transaction;

use Gmt\Core\Attributes\Required;
use Gmt\Core\Concerns\SdkModel;
use Gmt\Core\Contracts\BaseModel;
use Gmt\Profile\Referral\Transaction\TransactionListResponse\Amount;
use Gmt\Profile\Referral\Transaction\TransactionListResponse\BalanceAfter;
use Gmt\Profile\Referral\Transaction\TransactionListResponse\BalanceBefore;

/**
 * @phpstan-import-type AmountShape from \Gmt\Profile\Referral\Transaction\TransactionListResponse\Amount
 * @phpstan-import-type BalanceAfterShape from \Gmt\Profile\Referral\Transaction\TransactionListResponse\BalanceAfter
 * @phpstan-import-type BalanceBeforeShape from \Gmt\Profile\Referral\Transaction\TransactionListResponse\BalanceBefore
 *
 * @phpstan-type TransactionListResponseShape = array{
 *   id: int,
 *   amount: Amount|AmountShape,
 *   balanceAfter: BalanceAfter|BalanceAfterShape,
 *   balanceBefore: BalanceBefore|BalanceBeforeShape,
 *   createdAt: string,
 *   fromUserID: string|null,
 * }
 */
final class TransactionListResponse implements BaseModel
{
    /** @use SdkModel<TransactionListResponseShape> */
    use SdkModel;

    #[Required]
    public int $id;

    #[Required]
    public Amount $amount;

    #[Required('balance_after')]
    public BalanceAfter $balanceAfter;

    #[Required('balance_before')]
    public BalanceBefore $balanceBefore;

    #[Required('created_at')]
    public string $createdAt;

    #[Required('from_user_id')]
    public ?string $fromUserID;

    /**
     * `new TransactionListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TransactionListResponse::with(
     *   id: ...,
     *   amount: ...,
     *   balanceAfter: ...,
     *   balanceBefore: ...,
     *   createdAt: ...,
     *   fromUserID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TransactionListResponse)
     *   ->withID(...)
     *   ->withAmount(...)
     *   ->withBalanceAfter(...)
     *   ->withBalanceBefore(...)
     *   ->withCreatedAt(...)
     *   ->withFromUserID(...)
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
     * @param Amount|AmountShape $amount
     * @param BalanceAfter|BalanceAfterShape $balanceAfter
     * @param BalanceBefore|BalanceBeforeShape $balanceBefore
     */
    public static function with(
        int $id,
        Amount|array $amount,
        BalanceAfter|array $balanceAfter,
        BalanceBefore|array $balanceBefore,
        string $createdAt,
        ?string $fromUserID,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['amount'] = $amount;
        $self['balanceAfter'] = $balanceAfter;
        $self['balanceBefore'] = $balanceBefore;
        $self['createdAt'] = $createdAt;
        $self['fromUserID'] = $fromUserID;

        return $self;
    }

    public function withID(int $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * @param Amount|AmountShape $amount
     */
    public function withAmount(Amount|array $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * @param BalanceAfter|BalanceAfterShape $balanceAfter
     */
    public function withBalanceAfter(BalanceAfter|array $balanceAfter): self
    {
        $self = clone $this;
        $self['balanceAfter'] = $balanceAfter;

        return $self;
    }

    /**
     * @param BalanceBefore|BalanceBeforeShape $balanceBefore
     */
    public function withBalanceBefore(BalanceBefore|array $balanceBefore): self
    {
        $self = clone $this;
        $self['balanceBefore'] = $balanceBefore;

        return $self;
    }

    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    public function withFromUserID(?string $fromUserID): self
    {
        $self = clone $this;
        $self['fromUserID'] = $fromUserID;

        return $self;
    }
}
