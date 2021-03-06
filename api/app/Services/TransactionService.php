<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class TransactionService
{
    public function getFilteredTransactions($filters)
    {
        $transactions = Transaction::filter($filters)->select(
            [
                'id',
                'user_id',
                'wallet_from_id',
                'wallet_to_id',
                'category_id',
                'amount',
                'transacted_at',
                'transaction_type_id',
            ]
        )
            ->with(
                [
                    'walletFrom:id,name',
                    'walletTo:id,name',
                    'category:id,name',
                    'transactionType:id,name',
                ]
            )
            ->where('user_id', Auth::id())
            ->get();

        return [
            'transactions' => $transactions->toArray(),
            'total' => round($transactions->sum('amount'), 2),
        ];
    }

    public function create(array $data)
    {
        $data = Arr::add($data, 'user_id', Auth::id());

        return Transaction::query()
            ->create($data);
    }
}
