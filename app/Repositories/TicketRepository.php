<?php

namespace App\Repositories;

use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class TicketRepository
{
    protected $model;

    public function __construct(Ticket $ticket)
    {
        $this->model = $ticket;
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            return $this->model->create($data);
        });
    }

    public function getUserTickets($userId)
    {
        return $this->model->with(['event.venue'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getEventTicketsCount($eventId)
    {
        return $this->model->where('event_id', $eventId)->count();
    }

    public function getUserRecentTicketCount($userId, $minutes = 1)
    {
        return $this->model->where('user_id', $userId)
            ->where('created_at', '>=', now()->subMinutes($minutes))
            ->count();
    }
}