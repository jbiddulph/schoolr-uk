<?php

namespace App\Http\Controllers;

use App\Event;
use App\Venue;
use Mapper;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventslist = Event::latest()->where('is_live',1)->paginate(52);
        $events = Event::get();

        $towns = Venue::select('town')->distinct()->get();

        Mapper::map(50.8319292,-0.3155225, [
            'zoom' => 12,
            'marker' => false,
            'cluster' => false
        ]);
        foreach ($eventslist as $e) {
            Mapper::marker($e->venue->latitude, $e->venue->longitude);
            Mapper::informationWindow($e->venue->latitude, $e->venue->longitude, '<a href="/venues/' . str_slug($e->venue->town) . '/' . str_slug($e->venue->venuename) . '/'. $e->venue->id .'">' . $e->venue->venuename . '</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/primary_map_marker.png', 'scale' => 100]]);
        }
        return view('events.all', compact(
            'events',
            'towns',
            'eventslist'));

    }

    private function notFoundMessage()
    {

        return [
            'code' => 404,
            'message' => 'Note not found',
            'success' => false,
        ];

    }

    private function successfulMessage($code, $message, $status, $count, $payload)
    {

        return [
            'code' => $code,
            'message' => $message,
            'success' => $status,
            'count' => $count,
            'data' => $payload,
        ];

    }

    public function permanentDelete($id)
    {
        $event = Event::destroy($id);
        if ($event) {
            $response = $this->successfulMessage(200, 'Successfully deleted', true, 0, $event);
        } else {
            $response = $this->notFoundMessage();
        }
        //return response($response);
        return redirect('admin/event/softdeleted');
    }

    public function eventsWithSoftDelete()
    {

        $events = Event::withTrashed()->get();
        $response = $this->successfulMessage(200, 'Successfully', true, $events->count(), $events);
//        return response($response);
        return redirect('admin/event');
    }

    public function softDeleted()
    {
        $events = Event::onlyTrashed()->get();

        $response = $this->successfulMessage(200, 'Successfully', true, $events->count(), $events);
//        return response($response);
        return view('administration.admineventsdeleted', compact('events'));
    }

    public function restoreDeletedEvent($id)
    {

        $event = Event::onlyTrashed()->find($id);
        $events = Event::onlyTrashed()->get();
        if (!is_null($event)) {

            $event->restore();
            $response = $this->successfulMessage(200, 'Successfully restored', true, $event->count(), $event);
        } else {

            return response($response);
        }
        return redirect('admin/event');
//        return view('administration.admineventsdeleted', compact('events'));
    }
    public function permanentDeleteSoftDeleted($id)
    {
        $event = Event::onlyTrashed()->find($id);

        if (!is_null($event)) {

            $event->forceDelete();
            $response = $this->successfulMessage(200, 'Successfully deleted', true, 0, $event);
        } else {

            return response($response);
        }
//        return response($response);
        return redirect('admin/event');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
