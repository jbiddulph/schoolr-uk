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
                <div class="property-card card mb-4">
                    @if(isset($thevenue->photo))
                        @php
                            $mainphoto = str_replace('public/', 'storage/', $thevenue->photo)
                        @endphp
                        <div class="mainpic">
                            <a href="venues.show',[$thevenue->id, $thevenue->slug])}}"><img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="{{$thevenue->venuename}}"></a>
                        </div>
                    @endif
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
{{--                            <a class="btn btn-primary btn-sm" href="{{route('properties.show',[$thevenue->id, $thevenue->slug])}}">Enquire</a>--}}
                    </div>
                </div>
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
