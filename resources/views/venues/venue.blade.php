@extends('layouts.venue')

@section('content')
    <div class="colorbar"></div>
    <div style="width: 100%; height: 300px;">
        {!! Mapper::render() !!}
    </div>
    <div class="container mt-4 welcome">
        <h1>{{$thevenue->venuename}}, <a href="{{route('venues.town', [request('town')])}}" style="text-transform: capitalize;">{{request('town')}}</a></h1>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="property-card card mb-4">
                    @if(isset($thevenue->photo))
                        @php
                            $mainphoto = str_replace('public/', 'storage/', $thevenue->photo)
                        @endphp
                        <div class="mainpic">
                            <img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="{{$thevenue->venuename}}">
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
                        @if($thevenue->user_id != '')
                            <div class="flag flag-up"><i class="fas fa-key"></i></div>
                        @else
                            <a class="btn btn-primary btn-md" href="{{route('register.claim',["venue_id"=>$thevenue->id, "venue_name"=>$thevenue->slug])}}">Claim this venue</a>
                        @endif

                    </div>
                        <div class="qr-code" style="text-align:center; padding-bottom: 20px;">
                            <img src="{{url('qrcodes/'. $thevenue->town .'/customers/tagin-'.$thevenue->id.'.png')}}" width="250" />
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
