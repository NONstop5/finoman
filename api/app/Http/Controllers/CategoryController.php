<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\WalletRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @return JsonResponse
     */
    public function store(CategoryRequest $request):JsonResponse
    {
        $validated = $request->validated();

        return response()->json(
            Category::query()
            ->create([
                'user_id' => Auth::id(),
                'category_type_id' => $validated['category_type_id'],
                'name' => $validated['name'],
                'budget' => $validated['budget'],
                'icon' => 'tag'
            ]),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     *
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        return response()->json($category->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     *
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        $validated = $request->validated();

        return response()->json($category->update([
            'category_type_id' => $validated['category_type_id'],
            'name' => $validated['name'],
            'budget' => $validated['budget'],
            'icon' => 'tag'
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     *
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
