<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreBomRequest;
use App\Http\Requests\Product\UpdateBomRequest;
use App\Http\Resources\Product\BomResource;
use App\Services\Product\BomService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BomController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected BomService $service
    ) {}

    public function index(Request $request)
    {
        $boms = $this->service->index(
            filters: $request->only([
                'product_id',
                'status',
            ]),
            search: $request->search,
            sort: $request->sort,
            perPage: $request->integer('per_page', 10),
        );

        return $this->success(
            BomResource::collection($boms),
            'BOM list retrieved successfully.'
        );
    }

    public function store(StoreBomRequest $request)
    {
        $bom = $this->service->store(
            $request->validated()
        );

        return $this->success(
            new BomResource($bom),
            'BOM created successfully.',
            201
        );
    }

    public function show(int $id)
    {
        $bom = $this->service->show($id);

        return $this->success(
            new BomResource($bom),
            'BOM retrieved successfully.'
        );
    }

    public function update(
        UpdateBomRequest $request,
        int $id
    ) {
        $bom = $this->service->update(
            $id,
            $request->validated()
        );

        return $this->success(
            new BomResource($bom),
            'BOM updated successfully.'
        );
    }

    public function destroy(int $id)
    {
        $this->service->destroy($id);

        return $this->success(
            null,
            'BOM deleted successfully.'
        );
    }

    public function approve(int $id)
    {
        $bom = $this->service->approve(
            $id,
            auth()->id()

        );

        return $this->success(
            new BomResource($bom),
            'BOM approved successfully.'
        );
    }
}
