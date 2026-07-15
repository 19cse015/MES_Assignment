<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductCategoryRequest;
use App\Http\Requests\Product\UpdateProductCategoryRequest;
use App\Http\Resources\Product\ProductCategoryResource;
use App\Services\Product\ProductCategoryService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponse;

    public function __construct(
        protected ProductCategoryService $service
    ) {
    }

    public function index(Request $request)
    {
        $categories = $this->service->index([
            'filters' => $request->only('name'),
            'search' => $request->input('search'),
            'sort' => $request->input('sort'),
            'per_page' => $request->integer('per_page', 10),
        ]);

        return $this->success(
             ProductCategoryResource::collection($categories),
            'Product categories retrieved successfully.'
        );
    }

    public function store(StoreProductCategoryRequest $request)
    {
        $category = $this->service->store(
            $request->validated()
        );

        return $this->success(
            new ProductCategoryResource($category),
            'Product category created successfully.',
            201
        );
    }

    public function show(int $id)
    {
        return $this->success(
            new ProductCategoryResource(
                $this->service->show($id)
            )
        );
    }

    public function update(
        UpdateProductCategoryRequest $request,
        int $id
    ) {
        $category = $this->service->update(
            $id,
            $request->validated()
        );

        return $this->success(
            new ProductCategoryResource($category),
            'Product category updated successfully.'
        );
    }

    public function destroy(int $id)
    {
        $this->service->destroy($id);

        return $this->success(
            null,
            'Product category deleted successfully.'
        );
    }
}
