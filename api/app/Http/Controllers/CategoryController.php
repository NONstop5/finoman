<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function index(Request $request)
    {
        $validated = $this->validate(
            $request,
            [
                'category_type_id' => 'nullable|integer|exists:category_types,id',
            ]
        );

        $qb = Category::query()
            ->where('user_id', Auth::id());

        if (isset($validated['category_type_id'])) {
            $qb->where('category_type_id', $validated['category_type_id']);
        }

        $categoriesList = $qb->get();

        return response()->json($categoriesList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     *
     * @return void
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     *
     * @return void
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     *
     * @return void
     */
    public function destroy(Category $category)
    {
        //
    }
}
