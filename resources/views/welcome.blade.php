@extends('layouts.app')

@section('content')

        <div class="colorbar"></div>

    <div style="width: 100%; height: 300px;">
        {!! Mapper::render() !!}
    </div>
    <div class="container mt-4 welcome">
        <h1 class="mb-4">Venues</h1>
        <div class="row">
            @foreach($venues as $venue)
                <div class="col-md-3">
                    <div class="property-card card mb-4">
                        @if(isset($venue->photo))
                            @php
                                $mainphoto = str_replace('public/venues/', 'storage/venues/photos/', $venue->photo)
                            @endphp
                            <div class="mainpic">
                                <a href="{{route('properties.show',[$venue->id, $venue->slug])}}"><img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="{{$venue->venuename}}"></a>
                            </div>
                        @endif
                        <div class="card-body">
                            <h4 class="card-title"><a href="{{route('properties.show',[$venue->id, $venue->slug])}}">{{$venue->venuename}}</a></h4>
                            <div class="text-right"><a class="btn btn-primary btn-md" href="{{route('venues.show',[$venue->id, $venue->slug])}}">Enquire</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div>
            <a href="{{route('venues')}}">
                <button class="btn btn-secondary btn-lg mt-4" style="width: 100%;">Browse all Venues</button>
            </a>
        </div>

    </div>
    <div class="container">
        <div class="row">
{{--            @foreach($companies as $company)--}}
{{--                <div class="col-md-3">--}}
{{--                    <div class="card">--}}

{{--                        <img class="d-block img-fluid prop_photo" src="{{asset('uploads/logo')}}/{{ $company->logo }}" alt="Company Logo">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">{{$company->cname}}</h5>--}}
{{--                            <p class="card-text">{{str_limit($company->description, 20)}}</p>--}}
{{--                            <a href="{{route('company.index',[$company->id, $company->slug])}}" class="btn btn-primary">Visit Company</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
        </div>
    </div>
    <div class="colorbar mt-5"></div>
@endsection
