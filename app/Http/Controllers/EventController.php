<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\EventPostRequest;
use App\Venue;
use Illuminate\Support\Facades\Auth;
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
            Mapper::informationWindow($e->venue->latitude, $e->venue->longitude, '<a href="/venues/' . str_slug($e->venue->town) . '/' . str_slug($e->venue->venuename) . '/'. $e->venue->id .'">' . $e->venue->venuename . '</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/secondary_map_marker.png', 'scale' => 100]]);
        }
        return view('events.all', compact(
            'events',
            'towns',
            'eventslist'));

    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        $venueid = $event->venue_id;
        $thevenue = Venue::findOrFail($venueid);
        return view('events.show', compact(
            'event',
            'venueid',
            'thevenue'
        ));
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

    public function eventCreate() {
        $venueid = Auth::user()->venue_id;
        $thevenue = Venue::findOrFail($venueid);
        //dd($thevenue);
        return view('events.create', compact('venueid', 'thevenue'));
    }
    public function eventStore(EventPostRequest $request) {

        $eventphoto = $request->file('eventPhoto')->store('public/events/photos');
        Event::create([
            'venue_id'=>request('venue_id'),
            'eventName'=>request('eventName'),
            'slug'=>str_slug(request('eventName')),
            'eventPhoto'=>$eventphoto,
            'eventDate'=>request('eventDate'),
            'eventTimeStart'=>request('eventTimeStart'),
            'eventTimeEnd'=>request('eventTimeEnd'),
            'eventType'=>request('eventType'),
            'eventCost'=>request('eventCost')
        ]);


        return redirect()->back()->with('message','Event added successfully!');
    }
    public function eventEdit($id) {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }
    public function eventUpdate(Request $request, $id) {
        $event = Event::findOrFail($id);

        if ($request->file('eventPhoto') != ''){
            $eventphoto = $request->file('eventPhoto')->store('public/events/photos');
            $event->update([
                'eventPhoto'=>$eventphoto,
            ]);
        }

        $event->update([
            'venue_id'=>request('venue_id'),
            'eventName'=>request('eventName'),
            'slug'=>str_slug(request('eventName')),
            'eventDate'=>request('eventDate'),
            'eventTimeStart'=>request('eventTimeStart'),
            'eventTimeEnd'=>request('eventTimeEnd'),
            'eventType'=>request('eventType'),
            'eventCost'=>request('eventCost')
        ]);
        return redirect()->back()->with('message','Event successfully updated!');
    }
    public function eventuploadsedit($id) {
        $event = Event::findOrFail($id);
        return view('events.uploads-edit', compact('event'));
    }
    public function eventImageUpdate(Request $request, $id) {

        $event = Venue::findOrFail($id);
        $eventphoto = $request->file('eventPhoto')->store('public/events/photos');

        $event->update([
            'eventPhoto'=>$eventphoto,
        ]);
        return redirect()->back()->with('message','Event image updated!');
    }
}
