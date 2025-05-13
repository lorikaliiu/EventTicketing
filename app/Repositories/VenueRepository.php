<?php

namespace App\Repositories;

use App\Models\Venue;
use Illuminate\Support\Facades\DB;

class VenueRepository
{
    protected $model;

    public function __construct(Venue $venue)
    {
        $this->model = $venue;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            return $this->model->create($data);
        });
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $venue = $this->find($id);
            $venue->update($data);
            return $venue;
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $venue = $this->find($id);
            return $venue->delete();
        });
    }
}