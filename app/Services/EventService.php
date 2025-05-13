<?php


namespace App\Services;

use App\Repositories\EventRepository;
use App\Repositories\VenueRepository;

class EventService
{
    protected $eventRepository;
    protected $venueRepository;

    public function __construct(EventRepository $eventRepository, VenueRepository $venueRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->venueRepository = $venueRepository;
    }

    public function getAllEvents()
    {
        return $this->eventRepository->all();
    }

    public function getEvent($id)
    {
        return $this->eventRepository->find($id);
    }

    public function createEvent(array $data)
    {
        
        $this->venueRepository->find($data['venue_id']);
        
        return $this->eventRepository->create($data);
    }

    public function updateEvent($id, array $data)
    {
        if (isset($data['venue_id'])) {
            $this->venueRepository->find($data['venue_id']);
        }
        
        return $this->eventRepository->update($id, $data);
    }

    public function deleteEvent($id)
    {
        return $this->eventRepository->delete($id);
    }

    public function getUpcomingEvents($filters = [])
    {
        return $this->eventRepository->getUpcomingEvents($filters);
    }

    public function searchEvents($searchTerm)
    {
        return $this->eventRepository->searchEvents($searchTerm);
    }
}