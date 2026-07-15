<?php

namespace App\Http\Controllers\Api\V1\Material;

use App\Http\Controllers\Controller;
use App\Http\Requests\Material\StoreMaterialCategoryRequest;
use App\Http\Requests\Material\UpdateMaterialCategoryRequest;
use App\Http\Resources\Material\MaterialCategoryResource;
use App\Services\Material\MaterialCategoryService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class MaterialCategoryController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected MaterialCategoryService $service
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
            MaterialCategoryResource::collection($categories),
            'Material categories retrieved successfully.'
        );
    }

    public function store(StoreMaterialCategoryRequest $request)
    {
        $category = $this->service->store(
            $request->validated()
        );

        return $this->success(
            new MaterialCategoryResource($category),
            'Material category created successfully.',
            201
        );
    }

    public function show(int $id)
    {
        return $this->success(
            new MaterialCategoryResource(
                $this->service->show($id)
            )
        );
    }

    public function update(
        UpdateMaterialCategoryRequest $request,
        int $id
    ) {
        $category = $this->service->update(
            $id,
            $request->validated()
        );

        return $this->success(
            new MaterialCategoryResource($category),
            'Material category updated successfully.'
        );
    }

    public function destroy(int $id)
    {
        $this->service->destroy($id);

        return $this->success(
            null,
            'Material category deleted successfully.'
        );
    }
}
