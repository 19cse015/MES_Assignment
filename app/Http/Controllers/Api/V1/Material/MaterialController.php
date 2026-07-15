<?php

namespace App\Http\Controllers\Api\V1\Material;

use App\Http\Controllers\Controller;
use App\Http\Requests\Material\StoreMaterialRequest;
use App\Http\Requests\Material\UpdateMaterialRequest;
use App\Http\Resources\Material\MaterialResource;
use App\Services\Material\MaterialService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;


class MaterialController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected MaterialService $service
    ) {
    }

    public function index(Request $request)
    {
        $materials = $this->service->index([
            'filters' => $request->only([
                'category_id',
            ]),
            'search' => $request->input('search'),
            'sort' => $request->input('sort'),
            'per_page' => $request->integer('per_page', 10),
        ]);

        return $this->success(
            MaterialResource::collection($materials),
            'Materials retrieved successfully.'
        );
    }

    public function store(StoreMaterialRequest $request)
    {
        $material = $this->service->store(
            $request->validated()
        );

        return $this->success(
            new MaterialResource($material),
            'Material created successfully.',
            201
        );
    }

    public function show(int $id)
    {
        return $this->success(
            new MaterialResource(
                $this->service->show($id)
            )
        );
    }

    public function update(
        UpdateMaterialRequest $request,
        int $id
    ) {
        $material = $this->service->update(
            $id,
            $request->validated()
        );

        return $this->success(
            new MaterialResource($material),
            'Material updated successfully.'
        );
    }

    public function destroy(int $id)
    {
        $this->service->destroy($id);

        return $this->success(
            null,
            'Material deleted successfully.'
        );
    }
}
