<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Services\Product\ProductService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponse;

    public function __construct(
        protected ProductService $service
    ) {}

    public function index(Request $request)
    {
        $products = $this->service->index([
            'filters' => $request->only([
                'category_id',
                'status',
            ]),
            'search' => $request->input('search'),
            'sort' => $request->input('sort'),
            'per_page' => $request->integer('per_page', 10),
        ]);

        return $this->success(
            ProductResource::collection($products),
            'Products retrieved successfully.'
        );
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->service->store(
            $request->validated()
        );

        return $this->success(
            new ProductResource($product),
            'Product created successfully.',
            201
        );
    }

    public function show(int $id)
    {
        return $this->success(
            new ProductResource(
                $this->service->show($id)
            )
        );
    }

    public function update(
        UpdateProductRequest $request,
        int $id
    ) {
        $product = $this->service->update(
            $id,
            $request->validated()
        );

        return $this->success(
            new ProductResource($product),
            'Product updated successfully.'
        );
    }

    public function destroy(int $id)
    {
        $this->service->destroy($id);

        return $this->success(
            null,
            'Product deleted successfully.'
        );
    }
}
