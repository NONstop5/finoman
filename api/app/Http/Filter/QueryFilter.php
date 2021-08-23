<?php

namespace App\Http\Filter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class QueryFilter
{
    protected $request;
    protected $builder;
    protected $delimiter = ',';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $field => $value) {
            if (method_exists($this, $field)) {
                call_user_func_array([$this, $field], array_filter([$value]));
            }
        }

        return $this->builder;
    }

    public function filters()
    {
        if(!$this->request->has('amount')) {
            return $this->request->merge(['amount' => 5, 'data_order' => 'asc'])->query();
        } else {
            return $this->request->merge(['data_order' => 'asc'])->query();
        }
    }

    protected function paramToArray($param)
    {
        return explode($this->delimiter, $param);
    }

}
