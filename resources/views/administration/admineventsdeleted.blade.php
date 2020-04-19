@extends('layouts.app')

@section('content')
    <div class="colorbar"></div>
    <div class="container mt-4">
        <h1>Event Administration - <a href="/admin">Admin</a></h1>
        <h2>Deleted Events</h2>
        <a href="{{route('admin.event')}}">
            <button class="btn btn-secondary">< Back</button>
        </a>
        <a href="{{route('adminevent.create')}}">
            <button class="btn btn-secondary">Add Event</button>
        </a>
        <div class="row">
            @if(count($events) > 0)
                @foreach($events as $event)
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <div id="event{{ $event->id }}">
                                <div role="listbox">
                                    @if(isset($event->eventPhoto))
                                        @php
                                            $mainphoto = str_replace('public/', 'storage/', $event->eventPhoto)
                                        @endphp
                                        <div class="mainpic">
                                            <div class="edit-photo"><input data-id="{{$event->id}}" name="is_live" class="toggle-live-venue" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $event->is_live ? 'checked' : '' }}></div>
                                            <img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="Event">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('adminevent.edit',[$event->id])}}"><h3 class="card-title">{{$event->eventName}}</h3>
                                <p class="card-text short-description">
                                    {{ Carbon\Carbon::parse($event->eventDate)->format('l jS F Y') }}<br />
                                    {{ \Carbon\Carbon::parse($event->eventDate)->diffForhumans() }}
                                    Starts: <strong>{{$event->eventTimeStart}}</strong><br />
                                    Ends: <strong>{{$event->eventTimeEnd}}</strong>

                                </p>
                                </a>
                                <a href="{{route('event.restoredelete', [$event->id])}}">
                                    <button class="btn btn-warning btn-sm"><i class="fas fa-trash-restore-alt"></i> ({{$event->id}})</button>
                                </a>
                                <a href="{{route('event.permdelete', [$event->id])}}">
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> ({{$event->id}})</button>
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="colorbar mt-5"></div>
@endsection
