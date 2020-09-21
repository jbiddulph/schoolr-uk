@extends('layouts.list')

@section('content')
    <div class="colorbar"></div>
    <div style="width: 100%; height: 300px;">
        {!! Mapper::render() !!}
    </div>
    <small class="justify-content-center" style="width: 100%; display:flex;">Map markers are shown on paginated search of 52 max per page</small>

    <div class="container mt-4 welcome">
        <div class="row">
            @foreach($tagins as $tagin)
                <div class="col-md-2 col-sm-12">
                    <div class="venue-card card mb-12">
                        <div class="card-body">
                            {{--                        <h4 class="card-title"><a href="{{route('venues.show',[$venue->id, $venue->slug])}}">{{$venue->propname}}</a></h4>--}}

                            <div class="card-text">
                                <div class="phonenumber">{{$tagin->phone_number}}</div>
                            {{--                            <a class="btn btn-primary btn-sm" href="{{route('properties.show',[$venue->id, $venue->slug])}}">Enquire</a>--}}
                                <div class="emailaddress">{{$tagin->email_address}}</div>
                                {{--                            <a class="btn btn-primary btn-sm" href="{{route('properties.show',[$venue->id, $venue->slug])}}">Enquire</a>--}}
                                <div class="reason">{{$tagin->reason_visit}}</div>
                                <div class="marketing">{{$tagin->marketing}}</div>
                                <div class="address">{{$tagin->created_at}}</div>
                            </div>
                     </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="colorbar mt-5"></div>
@endsection
