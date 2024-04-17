<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ListProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller
{
    public function index(ListProductRequest $request): JsonResponse
    {
        $products = Product::productList($request);
        $productsCount = Product::productListCount($request);

        return response()->json([
            'list' => $products,
            'count' => $productsCount
        ], 200);
    }

    public function show(Request $request): JsonResponse
    {
        $id = $request->route('id');

        try {
            $product = Product::findOrFail($id);

            return response()->json($product, 200);
        } catch (ModelNotFoundException) {
            return response()->json([
                'error' => __('response.not_found', ['name' => __('model.product')])
            ], 404);
        }
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function update(StoreProductRequest $request): JsonResponse
    {
        $id = $request->route('id');

        try {
            $product = Product::findOrFail($id);
            $product->update($request->all());

            return response()->json($product, 200);
        } catch (ModelNotFoundException) {
            return response()->json([
                'error' => __('response.not_found', ['name' => __('model.product')])
            ], 404);
        }
    }

    public function destroy(Request $request): JsonResponse
    {
        $id = $request->route('id');

        try {
            Product::findOrFail($id)->delete();

            return response()->json(null, 204);
        } catch (ModelNotFoundException) {
            return response()->json([
                'error' => __('response.not_found', ['name' => __('model.product')])
            ], 404);
        }
    }
}
