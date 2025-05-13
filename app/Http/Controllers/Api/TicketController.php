<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
        $this->middleware('auth:sanctum');
    }

    public function store(TicketRequest $request, $eventId)
    {
        $ticket = $this->ticketService->bookTicket(
            Auth::id(),
            $eventId,
            $request->validated()
        );

        return response()->json($ticket, 201);
    }

    public function index(Request $request)
    {
        $tickets = $this->ticketService->getUserTickets(Auth::id());
        return response()->json($tickets);
    }
}
