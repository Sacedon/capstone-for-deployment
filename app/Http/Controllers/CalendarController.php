<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Notifications\EventNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;


class CalendarController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');

            // Get events
            $events = Event::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)
                ->get(['id', 'title', 'start', 'end', 'color']);



            return response()->json($events);
        }



        $userRole = Auth::user()->role;


        return view('calendar', ['userRole' => $userRole]);
    }



    public function createEvent(Request $request)
    {
        $data = $request->except('_token');
        $events = Event::create($data);
        return response()->json($events);
    }

    public function deleteEvent(Request $request)
    {
        $event = Event::find($request->id);
        return $event->delete();
    }

    public function updateEvent(Request $request)
    {
        // Validate the request
        $request->validate([
            'id' => 'required|exists:events,id',
            'title' => 'required',
        ]);

        // Find the event
        $event = Event::find($request->id);

        // Update event details
        $event->title = $request->title;
        // Add more fields to update if needed

        // Save the changes
        $event->save();

        // You can return a response if needed
        return response()->json(['message' => 'Event updated successfully']);
    }
}
