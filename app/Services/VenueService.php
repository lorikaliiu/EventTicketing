<?php

namespace App\Services;

use App\Repositories\VenueRepository;

class VenueService
{
    protected $venueRepository;

    public function __construct(VenueRepository $venueRepository)
    {
        $this->venueRepository = $venueRepository;
    }

    public function getAllVenues()
    {
        return $this->venueRepository->all();
    }

    public function getVenue($id)
    {
        return $this->venueRepository->find($id);
    }

    public function createVenue(array $data)
    {
        return $this->venueRepository->create($data);
    }

    public function updateVenue($id, array $data)
    {
        return $this->venueRepository->update($id, $data);
    }

    public function deleteVenue($id)
    {
        return $this->venueRepository->delete($id);
    }
}