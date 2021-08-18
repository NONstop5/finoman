<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CategoryService
{
    /**
     * Get filtered category list
     *
     * @param array|null $filters
     *
     * @return Builder[]|Collection
     */
    public function getList(array $filters = null)
    {
        $qb = Category::query()
            ->where('user_id', Auth::id());

        if (isset($filters['category_type_id'])) {
            $qb->where('category_type_id', $filters['category_type_id']);
        }

        return $qb->get();
    }

    /**
     * Create new category
     *
     * @param array $data
     *
     * @return Builder|Model
     */
    public function create(array $data)
    {
        $data = Arr::add($data, 'user_id', Auth::id());

        return Category::query()
            ->create($data);
    }
}
