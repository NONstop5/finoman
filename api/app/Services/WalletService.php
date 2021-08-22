<?php

namespace App\Services;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
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
            ->select(
                [
                    'id',
                    'wallet_type_id',
                    'currency_id',
                    'name',
                    'balance',
                    'icon',
                ]
            )
            ->with(
                [
                    'walletType:id,name',
                    'currency:id,name',
                ]
            )
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
        $data = Arr::add($data, 'user_id', Auth::id());

        return Wallet::query()
            ->create($data);
    }
}
