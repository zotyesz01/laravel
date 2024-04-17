<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\ListCategoryRequest;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoryController extends Controller
{
    public function index(ListCategoryRequest $request): JsonResponse
    {
        $categories = Category::categoryList($request);
        $categoriesCount = Category::categoryListCount($request);

        return response()->json([
            'list' => $categories,
            'count' => $categoriesCount
        ], 200);
    }

    public function show(Request $request): JsonResponse
    {
        $id = $request->route('id');

        try {
            $category = Category::findOrFail($id);

            return response()->json($category, 200);
        } catch (ModelNotFoundException) {
            return response()->json([
                'error' => __('response.not_found', ['name' => __('model.category')])
            ], 404);
        }
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function update(StoreCategoryRequest $request): JsonResponse
    {
        $id = $request->route('id');

        try {
            $category = Category::findOrFail($id);
            $category->update($request->all());

            return response()->json($category, 200);
        } catch (ModelNotFoundException) {
            return response()->json([
                'error' => __('response.not_found', ['name' => __('model.category')])
            ], 404);
        }
    }
}
