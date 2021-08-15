<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function allFiltered($filters)
    {
//        return Transaction::all();

        $transactions = Transaction::filter($filters)->select(
            [
                'id',
                'user_id',
                'wallet_from_id',
                'wallet_to_id',
                'category_id',
                'amount',
                'transacted_at',
                'transaction_type_id'
            ]
        )
            ->with(
                [
                    'walletFrom:id,name',
                    'walletTo:id,name',
                    'category:id,name',
                    'transactionType:id,name'
                ]
            )
            ->where('user_id', Auth::id())
            ->get();

        $transactions['total'] = $transactions->sum('amount');

        return $transactions;
    }
}
