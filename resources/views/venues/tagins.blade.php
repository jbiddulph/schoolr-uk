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
                {{--                <img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="{{$thevenue->school}}">--}}
            </div>
        @endif
        <div class="qr-code" style="text-align:center; padding-bottom: 10px;">
            <h3>Customer Tag-in</h3>
            <img src="{{url('qrcodes/'. $thevenue->town .'/customers/tagin-'.$thevenue->id.'.png')}}" width="180" />
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <h2>{{ Carbon\Carbon::parse($selecteddate)->format('l jS \of F Y') }}</h2>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Please select a date to filter <span class="caret"></span></button>
                    <ul class="dropdown-menu scrollable-menu" role="menu" style="width:310px; padding:10px;">
                        @foreach($data as $date)
                            <li><a href="{{ route('venue.venuetaginstats', [Auth::user()->venue_id, $date->taginDate]) }}">{{ Carbon\Carbon::parse($date->taginDate)->format('l jS \of F Y') }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Card View</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Table View</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @foreach($tagins as $tagin)
                            <div class="tagincards mt-4 welcome">

{{--                                <div class="col-md-2 col-sm-12">--}}
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
                                                <div class="address_1">{{$tagin->created_at}}</div>
                                            </div>
                                        </div>
                                    </div>
{{--                                </div>--}}
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="table table-striped mt-4">
                            <thead>
                            <tr>
                                <th>Phone number</th>
                                <th>Email Address</th>
                                <th>Reason for Visit</th>
                                <th>Marketing</th>
                                <th>Tagged in at</th>
                            </tr>
                            </thead>
                            @foreach($tagins as $tagin)
                            <tr>
                                <td><div class="phonenumber">{{$tagin->phone_number}}</div></td>
                                            {{--                            <a class="btn btn-primary btn-sm" href="{{route('properties.show',[$venue->id, $venue->slug])}}">Enquire</a>--}}
                                <td><div class="emailaddress">{{$tagin->email_address}}</div></td>
                                            {{--                            <a class="btn btn-primary btn-sm" href="{{route('properties.show',[$venue->id, $venue->slug])}}">Enquire</a>--}}
                                <td><div class="reason">{{$tagin->reason_visit}}</div></td>
                                <td><div class="marketing">{{$tagin->marketing}}</div></td>
                                <td><div class="address_1">{{$tagin->created_at}}</div></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="colorbar mt-5"></div>
    @endif
@endsection
