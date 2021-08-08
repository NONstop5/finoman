<?php

namespace App\Http\Filter;

use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Builder;

class TransactionFilter extends QueryFilter
{
    public function categories($ids)
    {
        return $this->builder->whereIn('category_id', $this->paramToArray($ids));
    }

    public function walletsFrom($ids)
    {
        return $this->builder->whereIn('wallet_from_id', $this->paramToArray($ids));
    }

    public function walletsTo($ids)
    {
        return $this->builder->whereIn('wallet_to_id', $this->paramToArray($ids));
    }

    public function types($ids)
    {
        return $this->builder->whereIn('transaction_type_id', $this->paramToArray($ids));
    }

    public function dateOrder($order = 'asc')
    {
        return $this->builder->orderBy('id', $order);
    }

    public function amount($amount = 3)
    {
        return $this->builder->limit($amount);
    }

    public function dateFrom($date)
    {
        return $this->builder->whereDate('transacted_at', '>=', $date);
    }

    public function dateTo($date)
    {
        return $this->builder->whereDate('transacted_at', '<=', $date);
    }

}
