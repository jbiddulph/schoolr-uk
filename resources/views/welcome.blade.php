@extends('layouts.app')

@section('content')
    @if($loggedin && Auth::user()->user_type=='company')
        <div class="container-fluid" style="border-top:6px solid {{Auth::user()->company->primary_color}}"></div>
    @else
        <div class="colorbar"></div>
    @endif
    <div style="width: 100%; height: 300px;">
        {!! Mapper::render() !!}
    </div>
    <div class="container mt-4 welcome">
        <h1 class="mb-4">Properties</h1>
        <div class="row">
                @foreach($properties as $property)
                    <div class="col-md-3">
                        <div class="property-card card mb-4">
                            @if(isset($property->propimage))
                                @php
                                    $mainphoto = str_replace('public/', 'storage/', $property->propimage)
                                @endphp
                                <div class="mainpic">
                                    <a href="{{route('properties.show',[$property->id, $property->slug])}}"><img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="{{$property->propname}}"></a>
                                </div>
                            @endif
                            <div class="card-body">
                                <h4 class="card-title"><a href="{{route('properties.show',[$property->id, $property->slug])}}">{{$property->propname}}</a></h4>
                                <h5 class="card-subtitle text-right">&pound;{!! number_format($property->propcost); !!}</h5>
                                <p class="card-text short-description">{{ $property->short_summary }}</p>
                                <div class="text-right"><a class="btn btn-primary btn-md" href="{{route('properties.show',[$property->id, $property->slug])}}">Enquire</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
        <div>
            <a href="{{route('allproperties')}}">
                <button class="btn btn-secondary btn-lg mt-4" style="width: 90%; text-align:center;">Browse all Properties</button>
            </a>
        </div>
        <h2 class="mb-4 mt-4">Featured Companies</h2>
    </div>
    <div class="container">
        <div class="row">
            @foreach($companies as $company)
                <div class="col-md-3">
                    <div class="card">

                        <img class="d-block img-fluid prop_photo" src="{{asset('uploads/logo')}}/{{ $company->logo }}" alt="Company Logo">
                        <div class="card-body">
                            <h5 class="card-title">{{$company->cname}}</h5>
                            <p class="card-text">{{str_limit($company->description, 20)}}</p>
                            <a href="{{route('company.index',[$company->id, $company->slug])}}" class="btn btn-primary">Visit Company</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="colorbar mt-5"></div>
@endsection
