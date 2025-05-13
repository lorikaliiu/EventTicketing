<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
        $this->middleware('auth:sanctum')->except(['index', 'show', 'upcoming', 'search']);
    }

    public function index()
    {
        $events = $this->eventService->getAllEvents();
        return response()->json($events);
    }

    public function store(EventRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        
        $event = $this->eventService->createEvent($data);
        return response()->json($event, 201);
    }

    public function show($id)
    {
        $event = $this->eventService->getEvent($id);
        return response()->json($event);
    }

    public function update(EventRequest $request, $id)
    {
        $event = $this->eventService->updateEvent($id, $request->validated());
        return response()->json($event);
    }

    public function destroy($id)
    {
        $this->eventService->deleteEvent($id);
        return response()->json(null, 204);
    }

    public function upcoming(Request $request)
    {
        $filters = $request->only(['venue_id', 'category', 'start_date', 'end_date']);
        $events = $this->eventService->getUpcomingEvents($filters);
        return response()->json($events);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->query('q');
        if (empty($searchTerm)) {
            return response()->json(['message' => 'Search term is required'], 400);
        }

        $events = $this->eventService->searchEvents($searchTerm);
        return response()->json($events);
    }
}