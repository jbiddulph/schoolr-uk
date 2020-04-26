@extends('layouts.list')

@section('content')
    <div class="colorbar"></div>
    <div style="width: 100%; height: 300px;">
        {!! Mapper::render() !!}
    </div>
    <small class="justify-content-center" style="width: 100%; display:flex;">Map markers are shown on paginated search of 52 max per page</small>
    <div class="container-fluid mt-4 welcome">
        <h1>Events</h1>
        <div class="row">
            <ul class="towns-list">
            @foreach($towns as $town)
                <li><h3><a href="{{route('venues.town', [$town->town])}}" class="btn btn-secondary btn-sm">{{$town->town}}</a></h3></li>
            @endforeach
            </ul>
        </div>
        <div class="grid mt-4" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 200 }'>
            @foreach($eventslist as $event)
                <div class="grid-list">
                    <div class="venue-card card mb-4">
                        @if(isset($event->eventPhoto))
                            @php
                                $mainphoto = str_replace('public/', 'storage/', $event->eventPhoto)
                            @endphp
                            <div class="mainpic">
                                <a href="/events/{{$event->id}}"><img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="{{$event->eventName}}" width="180"></a>
                            </div>
                        @endif
                        <div class="card-body">
                            <strong>{{$event->eventType}}</strong>
                            <h4>{{$event->eventName}}</h4>
                            <h5 class="card-subtitle text-right">at the {{$event->venue->venuename}} in {{$event->venue->town}}</h5>
                            <p class="card-text">{{$event->eventDate}}<br />
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            <div class="offset-md-2 col-md-8 text-center">
                {{$eventslist->links()}}
            </div>
        </div>
    </div>
    <div class="colorbar mt-5"></div>
@endsection
