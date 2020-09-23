@extends('layouts.list')

@section('content')
    @if(Auth::user()->user_type=='admin' || Auth::user()->venue_id==$thevenue->id && Auth::user()->user_type=='landlord')
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

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="bold"></h2>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Please select a date to filter <span class="caret"></span></button>
                    <ul class="dropdown-menu scrollable-menu" role="menu" style="width:310px; padding:10px;">
                        @foreach($data as $date)
                            <li><a href="{{ route('venue.venuetaginstats', [Auth::user()->venue_id, $date->taginDate]) }}">{{ Carbon\Carbon::parse($date->taginDate)->format('l jS \of F Y') }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

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
    @endif
@endsection
