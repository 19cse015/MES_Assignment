<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;


    protected array $searchable = [];


    protected array $filterable = [];


    protected array $sortable = [];
    protected array $relations = [];

    public function paginate(
        array $filters = [],
        ?string $search = null,
        ?string $sort = null,
        int $perPage = 10
    ) {
        $query = $this->model
            ->newQuery()
            ->with($this->relations);

        $this->applySearch($query, $search);

        $this->applyFilters($query, $filters);

        $this->applySorting($query, $sort);

        return $query->paginate($perPage);
    }

    protected function applySearch(
        Builder $query,
        ?string $search
    ): void {

        if (!$search || empty($this->searchable)) {
            return;
        }

        $query->where(function ($q) use ($search) {

            foreach ($this->searchable as $column) {

                $q->orWhere($column, 'ILIKE', "%{$search}%");
            }
        });
    }

    protected function applyFilters(
        Builder $query,
        array $filters
    ): void {

        foreach ($filters as $field => $value) {

            if (
                in_array($field, $this->filterable)
                && $value !== null
            ) {

                $query->where($field, $value);
            }
        }
    }

    protected function applySorting(
        Builder $query,
        ?string $sort
    ): void {

        if (!$sort) {

            $query->latest();

            return;
        }

        $direction = str_starts_with($sort, '-')
            ? 'desc'
            : 'asc';

        $column = ltrim($sort, '-');

        if (in_array($column, $this->sortable)) {

            $query->orderBy($column, $direction);
        }
    }

    public function find(int $id)
    {
        return $this->model
            ->with($this->relations)
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $model = $this->find($id);

        $model->update($data);

        return $model;
    }

    public function delete(int $id)
    {
        return $this->find($id)->delete();
    }
}
