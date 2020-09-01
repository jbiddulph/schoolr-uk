@extends('layouts.venue')

@section('content')
    <div class="colorbar"></div>
    <div style="width: 100%; height: 300px;">
        {!! Mapper::render() !!}
    </div>
    <div class="container mt-4 welcome">
        <h1>{{$thevenue->venuename}}, <a href="{{route('venues.town', [request('town')])}}" style="text-transform: capitalize;">{{request('town')}}</a></h1>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="venue-card card mb-4">
                    @if(isset($thevenue->photo))
                        @php
                            $mainphoto = str_replace('public/', 'storage/', $thevenue->photo)
                        @endphp
                        <div class="mainpic">
                            <a href="/venues/{{ str_slug($thevenue->town)}}/{{str_slug($thevenue->venuename)}}/{{$thevenue->id}}" style="background-image: url('/\{{ $mainphoto }}'); background-repeat: no-repeat;     background-size: cover;
                                display: block;
                                width: 100%;
                                height: 120px;">
                                {{--                                    <img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="{{$venue->venuename}}" width="180">--}}
                            </a>
                            <h2 class="card-subtitle">{{$thevenue->venuename}}</h2>
                            <span class="postal">{{$thevenue->postalsearch}}</span>
                        </div>
                    @endif
                    <div class="card-body">
                        {{--                        <h4 class="card-title"><a href="{{route('venues.show',[$venue->id, $venue->slug])}}">{{$venue->propname}}</a></h4>--}}

                        <div class="card-text">
                            <div class="address">{{$thevenue->address}}<br />
                                @if($thevenue->address2 != '')
                                    {{$thevenue->address2}}<br />
                                @endif
                                {{$thevenue->town}}<br />
                                {{$thevenue->county}}<br />
                                {{$thevenue->postcode}}</div>
                            <span><a href="tel:{{$thevenue->telephone}}"><i class="fas fa-2x fa-phone-alt"></i></a></span>
                        </div>
                        {{--                            <a class="btn btn-primary btn-sm" href="{{route('properties.show',[$venue->id, $venue->slug])}}">Enquire</a>--}}
                    </div>
                </div>
            </div>
            <div class="col-md-9">

                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Covid-19 Lockdown notice</strong> Due to the current lockdown and social distancing measures that are in place to help save lives, venues and pubs will have a limited amount of events listed.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                @foreach($events as $event)
                    {{$event->eventName}}
                @endforeach
            </div>
        </div>
        <div class="row">
            <ul class="towns-list">
                @foreach($towns as $town)
                    <li><h3><a href="{{route('venues.town', [$town->town])}}" class="btn btn-secondary btn-md">{{$town->town}}</a></h3></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="colorbar mt-5"></div>
@endsection
