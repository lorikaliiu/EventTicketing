<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VenueRequest;
use App\Services\VenueService;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    protected $venueService;

    public function __construct(VenueService $venueService)
    {
        $this->venueService = $venueService;
        $this->middleware('auth:sanctum');
        $this->middleware('admin')->except(['index', 'show']);
    }

    public function index()
    {
        $venues = $this->venueService->getAllVenues();
        return response()->json($venues);
    }

    public function store(VenueRequest $request)
    {
        $venue = $this->venueService->createVenue($request->validated());
        return response()->json($venue, 201);
    }

    public function show($id)
    {
        $venue = $this->venueService->getVenue($id);
        return response()->json($venue);
    }

    public function update(VenueRequest $request, $id)
    {
        $venue = $this->venueService->updateVenue($id, $request->validated());
        return response()->json($venue);
    }

    public function destroy($id)
    {
        $this->venueService->deleteVenue($id);
        return response()->json(null, 204);
    }
}