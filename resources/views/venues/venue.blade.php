@extends('layouts.venue')

@section('content')
    <div class="colorbar"></div>
    <div style="height: 300px;" class="header-img">
        @if(isset($thevenue->photo))
            @php
                $mainphoto = str_replace('public/', 'storage/', $thevenue->photo)
            @endphp
            <div class="mainpic" style="background-image: url(/{{ $mainphoto }})">
{{--                <img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="{{$thevenue->venuename}}">--}}
            </div>
        @endif
            <div class="qr-code" style="text-align:center; padding-bottom: 10px;">
                <h3>Customer Tag-in</h3>
                <img src="{{url('qrcodes/'. $thevenue->town .'/customers/tagin-'.$thevenue->id.'.png')}}" width="180" />
            </div>
    </div>
    <div class="container mt-4 welcome">
        <h1>{{$thevenue->venuename}}, <a href="{{route('venues.town', [$thevenue->town])}}" style="text-transform: capitalize;">{{$thevenue->town}}</a> <a href="{{route('venue.venuetagin', [$thevenue->id])}}" style="text-transform: capitalize;" class="btn btn-lg btn-primary">Check-in</a></h1>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="property-card card mb-4">
{{--                    MAP--}}
                    <div style="width: 100%; height: 300px;">
                        {!! Mapper::render() !!}
                    </div>
                    <div class="card-body">
                        <strong>{{$thevenue->postalsearch}}</strong>
{{--                            <h4 class="card-title"><a href="{{route('venues.show',[$thevenue->id, $thevenue->slug])}}">{{$thevenue->propname}}</a></h4>--}}
                        <h5 class="card-subtitle text-right">{{$thevenue->venuename}}</h5>
                        <p class="card-text">{{$thevenue->address}}<br />
                        {{$thevenue->address2}}<br />
                        {{$thevenue->town}}<br />
                        {{$thevenue->county}}<br />
                        {{$thevenue->postcode}}</p>
                        <p class="card-text short-description">{{$thevenue->telephone}}</p>
                        @if($thevenue->user_id != '')
                            <div class="flag flag-up"><i class="fas fa-key"></i></div>
                        @else
                            <a class="btn btn-primary btn-lg" href="{{route('register.claim',["venue_id"=>$thevenue->id, "venue_name"=>$thevenue->slug])}}">Claim this venue</a>
                        @endif

                    </div>
                </div>
            </div>
            <div class="col-md-8">

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Covid-19 Lockdown notice</strong> Due to the current lockdown and social distancing measures that are in place to help save lives, venues and pubs will have a limited amount of events listed.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="inline-flex">
                @foreach($events as $event)
                    <div class="col-md-4 col-sm-12">
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
{{--                @foreach($events as $event)--}}
{{--                    {{$event->eventName}}--}}
{{--                    {{$event->eventPhoto}}--}}
{{--                    {{$event->eventDate}}--}}
{{--                    {{$event->eventTimeStart}}--}}
{{--                    {{$event->eventTimeEnd}}--}}
{{--                    {{$event->eventType}}--}}
{{--                    {{$event->eventCost}}--}}
{{--                @endforeach--}}
            </div>
        </div>
        <div class="row">
            <ul class="towns-list">
                @foreach($towns as $town)
                    <li><h3><a href="{{route('venues.town', [$town->town])}}" class="btn btn-secondary btn-lg hvr-grow-rotate">{{$town->town}}</a></h3></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="colorbar mt-5"></div>
@endsection
