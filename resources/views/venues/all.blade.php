@extends('layouts.app')

@section('content')
    <div class="colorbar"></div>
    <div style="width: 100%; height: 300px;">
        {!! Mapper::render() !!}
    </div>
    <form action="{{route('venues')}}" name="mapswitchform" id="mapswitchform" method="post" enctype="multipart/form-data">@csrf
        <div class="switchdesc justify-content-center text-center">
            <span>Paginated</span>
            <label class="switch">
                <input name="mapswitch" type="checkbox" {{$checked}}>
                <span class="slider round"></span>
            </label>
            <span>All</span>
        </div>
    </form>
    <div class="container mt-4 welcome">
        <h1>Venues</h1>
        <div class="row">
            <ul class="towns-list">
            @foreach($towns as $town)
                <li><h3><a href="{{route('venues.town', [$town->town])}}" class="btn btn-secondary btn-sm">{{$town->town}}</a></h3></li>
            @endforeach
            </ul>
        </div>
        <div class="row">
            @foreach($venueslist as $venue)
                <div class="col-md-3">
                    <div class="property-card card mb-4">
{{--                        @if(isset($venue->propimage))--}}
{{--                            @php--}}
{{--                                $mainphoto = str_replace('public/', 'storage/', $venue->propimage)--}}
{{--                            @endphp--}}
{{--                            <div class="mainpic">--}}
{{--                                <a href="{{route('properties.show',[$venue->id, $venue->slug])}}"><img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="{{$venue->propname}}"></a>--}}
{{--                            </div>--}}
{{--                        @endif--}}
                        <div class="card-body">
{{--                            <h4 class="card-title"><a href="{{route('properties.show',[$venue->id, $venue->slug])}}">{{$venue->propname}}</a></h4>--}}
                            <h5 class="card-subtitle text-right">{{$venue->venuename}}</h5>
{{--                            <p class="card-text short-description">{{$venue->description}}</p>--}}
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
    </div>
    <div class="colorbar mt-5"></div>
@endsection
