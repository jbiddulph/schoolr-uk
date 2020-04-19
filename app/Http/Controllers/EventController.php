<?php

namespace App\Http\Controllers;

use App\Event;
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
        //
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
