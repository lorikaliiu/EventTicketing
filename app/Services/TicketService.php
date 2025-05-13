<?php

namespace App\Services;

use App\Models\Event;
use App\Repositories\EventRepository;
use App\Repositories\TicketRepository;
use Illuminate\Support\Facades\RateLimiter;

class TicketService
{
    protected $ticketRepository;
    protected $eventRepository;

    public function __construct(TicketRepository $ticketRepository, EventRepository $eventRepository)
    {
        $this->ticketRepository = $ticketRepository;
        $this->eventRepository = $eventRepository;
    }

    public function bookTicket($userId, $eventId, $data)
    {
        
        if ($this->ticketRepository->getUserRecentTicketCount($userId) >= 3) {
            abort(429, 'Too many ticket requests. Please try again later.');
        }

        $event = $this->eventRepository->find($eventId);
        
       
        $ticketsCount = $this->ticketRepository->getEventTicketsCount($eventId);
        if ($ticketsCount >= $event->venue->capacity) {
            abort(400, 'This event is sold out.');
        }

        $ticketData = array_merge($data, [
            'user_id' => $userId,
            'event_id' => $eventId,
            'price' => $event->price,
        ]);

        $ticket = $this->ticketRepository->create($ticketData);

        // In a real app, you would send a confirmation email here
        // Mail::to($user)->send(new TicketConfirmation($ticket));

        return $ticket;
    }

    public function getUserTickets($userId)
    {
        return $this->ticketRepository->getUserTickets($userId);
    }
}