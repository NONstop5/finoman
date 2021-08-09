<?php

namespace App\Http\Filter;

use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Builder;

class TransactionFilter extends QueryFilter
{
    public function category_id($ids)
    {
        return $this->builder->whereIn('category_id', $ids);
    }

    public function wallet_from_id($ids)
    {
        return $this->builder->whereIn('wallet_from_id', $ids);
    }

    public function wallet_to_id($ids)
    {
        return $this->builder->whereIn('wallet_to_id', $ids);
    }

    public function transaction_type_id($ids)
    {
        return $this->builder->whereIn('transaction_type_id', $ids);
    }

    public function data_order($order = 'asc')
    {
        return $this->builder->orderBy('id', $order);
    }

    public function amount($amount = 3)
    {
        return $this->builder->limit($amount);
    }

    public function transacted_at_from($date)
    {
        return $this->builder->whereDate('transacted_at', '>=', $date);
    }

    public function transacted_at_to($date)
    {
        return $this->builder->whereDate('transacted_at', '<=', $date);
    }

}
