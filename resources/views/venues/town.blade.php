@extends('layouts.list')

@section('content')
    <div class="colorbar"></div>
    <div style="width: 100%; height: 300px;">
        {!! Mapper::render() !!}
    </div>
    <div class="container mt-4 welcome">
        <h1>Venues in {{request('town')}}</h1>
        <div class="grid mt-4">
            @foreach($venueslist as $venue)
                <div class="grid-list">
                    <div class="venue-card card mb-4">
                        @if(isset($venue->photo))
                            @php
                                $mainphoto = str_replace('public/', 'storage/', $venue->photo)
                            @endphp
                            <div class="mainpic">
                                <a href="/venues/{{ str_slug($venue->town)}}/{{str_slug($venue->venuename)}}/{{$venue->id}}"><img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="{{$venue->venuename}}" width="180"></a>
                                <span class="postal">{{$venue->postalsearch}}</span>
                            </div>
                        @endif
                        <div class="card-body">
{{--                        <h4 class="card-title"><a href="{{route('venues.show',[$venue->id, $venue->slug])}}">{{$venue->propname}}</a></h4>--}}
                            <h5 class="card-subtitle">{{$venue->venuename}}</h5>
                            <p class="card-text">{{$venue->address}}<br />
                            @if($venue->address2 != '')
                                {{$venue->address2}}<br />
                            @endif
                            {{$venue->town}}<br />
                            {{$venue->county}}<br />
                            {{$venue->postcode}}</p>
                            <p class="card-text short-description"><i class="fas fa-phone-alt"></i>&nbsp;{{$venue->telephone}}</p>
{{--                            <a class="btn btn-primary btn-sm" href="{{route('properties.show',[$venue->id, $venue->slug])}}">Enquire</a>--}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            <div class="offset-md-2 col-md-8 text-center">
                {{$venueslist->links()}}
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
