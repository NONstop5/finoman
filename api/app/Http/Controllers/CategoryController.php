<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param CategoryRequest $request
     *
     * @return JsonResponse
     */
    public function index(CategoryRequest $request)
    {
        return response()->json($this->categoryService->getList($request->validated()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     *
     * @return JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        return response()->json($this->categoryService->create($request->validated()), Response::HTTP_CREATED);
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
     * @param CategoryRequest $request
     * @param Category $category
     *
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        return response()->json($category->update($request->validated()), Response::HTTP_ACCEPTED);
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
