<?php

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Support\Facades\DB;

class EventRepository
{
    protected $model;

    public function __construct(Event $event)
    {
        $this->model = $event;
    }

    public function all()
    {
        return $this->model->with(['venue', 'creator'])->get();
    }

    public function find($id)
    {
        return $this->model->with(['venue', 'creator'])->findOrFail($id);
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
            $event = $this->find($id);
            $event->update($data);
            return $event;
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $event = $this->find($id);
            return $event->delete();
        });
    }

    public function getUpcomingEvents($filters = [])
    {
        $query = $this->model->with(['venue', 'creator'])
            ->where('start_time', '>', now());

        if (isset($filters['venue_id'])) {
            $query->where('venue_id', $filters['venue_id']);
        }

        if (isset($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (isset($filters['start_date']) && isset($filters['end_date'])) {
            $query->whereBetween('start_time', [$filters['start_date'], $filters['end_date']]);
        }

        return $query->orderBy('start_time')->get();
    }

    public function searchEvents($searchTerm)
    {
        return $this->model->where('name', 'like', "%$searchTerm%")
            ->orWhereHas('venue', function($query) use ($searchTerm) {
                $query->where('name', 'like', "%$searchTerm%");
            })
            ->with(['venue', 'creator'])
            ->get();
    }
}