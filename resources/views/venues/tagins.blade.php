@extends('layouts.list')

@section('content')
    <div class="colorbar"></div>
    <div style="width: 100%; height: 300px;">
        {!! Mapper::render() !!}
    </div>
    <small class="justify-content-center" style="width: 100%; display:flex;">Map markers are shown on paginated search of 52 max per page</small>
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
        <div class="row">
            @foreach($tagins as $tagin)
                <div class="col-md-2 col-sm-12">
                    <div class="venue-card card mb-4">
                        <div class="card-body">
                            {{--                        <h4 class="card-title"><a href="{{route('venues.show',[$venue->id, $venue->slug])}}">{{$venue->propname}}</a></h4>--}}

                            <div class="card-text">
                                <div class="address">{{$tagin->phone_number}}<br />
                                </div>
                            {{--                            <a class="btn btn-primary btn-sm" href="{{route('properties.show',[$venue->id, $venue->slug])}}">Enquire</a>--}}
                            </div>
                     </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="colorbar mt-5"></div>
@endsection
