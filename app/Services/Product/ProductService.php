<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepository;

class ProductService
{
    public function __construct(
        protected ProductRepository $repository
    ) {
    }

    public function index(array $params)
    {
        return $this->repository->paginate(
            filters: $params['filters'] ?? [],
            search: $params['search'] ?? null,
            sort: $params['sort'] ?? null,
            perPage: $params['per_page'] ?? 10
        );
    }

    public function show(int $id)
    {
        return $this->repository->find($id);
    }

    public function store(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function destroy(int $id)
    {
        return $this->repository->delete($id);
    }
}
