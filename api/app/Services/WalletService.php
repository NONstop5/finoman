<?php

namespace App\Services;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class WalletService
{
    /**
     * Get filtered wallet list
     *
     * @param array|null $filters
     *
     * @return Builder[]|Collection
     */
    public function getList(array $filters = null)
    {
        $qb = Wallet::query()
            ->where('user_id', Auth::id());

        if (isset($filters['wallet_type_id'])) {
            $qb->where('wallet_type_id', $filters['wallet_type_id']);
        }

        return $qb->get();
    }

    /**
     * Create new wallet
     *
     * @param array $data
     *
     * @return Builder|Model
     */
    public function create(array $data)
    {
        return Wallet::query()
            ->create(
                [
                    'user_id' => Auth::id(),
                    'currency_id' => 1,
                    'wallet_type_id' => $data['wallet_type_id'],
                    'name' => $data['name'],
                    'balance' => $data['balance'],
                    'balance_date' => $data['balance_date'],
                    'icon' => $data['icon'],
                ]
            );
    }

    /**
     * Update existed wallet
     *
     * @param array $data
     * @param Wallet $wallet
     *
     * @return bool
     */
    public function update(array $data, Wallet $wallet)
    {
        return $wallet->update(
            [
                'wallet_type_id' => $data['wallet_type_id'],
                'name' => $data['name'],
                'balance' => $data['balance'],
                'balance_date' => $data['balance_date'],
                'icon' => $data['icon'],
            ]
        );
    }
}
