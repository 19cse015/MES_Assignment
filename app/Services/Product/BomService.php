<?php

namespace App\Services\Product;

use App\Enums\BomStatusEnum;
use App\Models\Bom;
use App\Repositories\Product\BomRepository;
use Illuminate\Validation\ValidationException;
use App\Models\BomItem;
use Illuminate\Support\Facades\DB;

class BomService
{
    public function __construct(
        protected BomRepository $repository
    ) {}

    public function index(array $filters, ?string $search, ?string $sort, int $perPage)
    {
        return $this->repository->paginate(
            filters: $filters,
            search: $search,
            sort: $sort,
            perPage: $perPage,
        );
    }

    public function show(int $id): Bom
    {
        return $this->repository->find($id);
    }
    public function store(array $data): Bom
    {
        $this->validateVersion(
            $data['product_id'],
            $data['version']
        );

        return DB::transaction(function () use ($data) {

            $bom = $this->repository->create([
                'product_id' => $data['product_id'],
                'version' => $data['version'],
                'status'     => BomStatusEnum::DRAFT->value
            ]);

            $this->createItems(
                $bom->id,
                $data['items']
            );

            return $this->repository->find($bom->id);
        });
    }
    public function update(
        int $id,
        array $data
    ): Bom {

        $bom = $this->repository->find($id);

        $this->validateVersion(
            $data['product_id'],
            $data['version'],
            $bom->id
        );

        return DB::transaction(function () use ($bom, $data) {

            $this->repository->update($bom->id, [

                'product_id' => $data['product_id'],

                'version' => $data['version'],

                'status' => $data['status'],

            ]);

            $this->replaceItems(
                $bom,
                $data['items']
            );

            return $this->repository->find($bom->id);
        });
    }
    public function approve(
        int $id,
        int $userId
    ): Bom {

        $bom = $this->repository->find($id);

        if ($bom->status === BomStatusEnum::APPROVED->value) {

            throw ValidationException::withMessages([

                'status' => [
                    'BOM is already approved.'
                ]

            ]);
        }

        $this->repository->update($id, [

            'status' => BomStatusEnum::APPROVED->value,

            'approved_by' => $userId,

            'approved_at' => now(),

        ]);

        return $this->repository->find($id);
    }

    protected function validateVersion(
        int $productId,
        int $version,
        ?int $ignoreId = null
    ): void {

        $exists = Bom::query()
            ->where('product_id', $productId)
            ->where('version', $version)
            ->when(
                $ignoreId,
                fn($query) => $query->where('id', '!=', $ignoreId)
            )
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'version' => [
                    'This version already exists for the selected product.'
                ]
            ]);
        }
    }
    protected function createItems(
        int $bomId,
        array $items
    ): void {

        $rows = [];

        foreach ($items as $item) {

            $rows[] = [

                'bom_id' => $bomId,

                'material_id' => $item['material_id'],

                'quantity' => $item['quantity'],

                'created_at' => now(),

                'updated_at' => now(),

            ];
        }

        BomItem::insert($rows);
    }
    protected function replaceItems(
        Bom $bom,
        array $items
    ): void {

        $bom->items()->delete();

        $this->createItems(
            $bom->id,
            $items
        );
    }
    public function destroy(
        int $id
    ): bool {

        return DB::transaction(function () use ($id) {

            $bom = $this->repository->find($id);

            $bom->items()->delete();

            return $this->repository->delete($id);
        });
    }
}
