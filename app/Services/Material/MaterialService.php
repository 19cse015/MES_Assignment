<?php

namespace App\Services\Material;

use App\Repositories\Material\MaterialRepository;

class MaterialService
{
    public function __construct(
        protected MaterialRepository $repository
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
