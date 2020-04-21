@extends('layouts.app')

@section('content')
    <div class="colorbar"></div>
    <div class="container mt-4">
        <h1>Property Administration - <a href="/admin">Admin</a></h1>
        <a href="{{route('adminproperty.create')}}">
            <button class="btn btn-secondary">Add Property</button>
        </a>
        <div class="row">
            @if(count($properties) > 0)
                @foreach($properties as $property)
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <div id="property{{ $property->id }}">
                                <div role="listbox">
                                    @if(isset($property->propimage))
                                        @php
                                            $mainphoto = str_replace('public/', 'storage/', $property->propimage)
                                        @endphp
                                        <div class="mainpic">
                                            <div class="edit-photo"><a href="{{route('adminproperty.uploadsedit',[$property->id])}}"><i class="fas fa-camera fa-2x"></i></a></div>
                                            <img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="Property">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">{{$property->propname}}</h4>
                                <h5 class="card-subtitle text-right">&pound;{{$property->propcost}}</h5>
                                <p class="card-text">
                                    @if(empty(Auth::user()->company->logo))
                                        <img src="{{asset('avatar/default.png')}}" width="80" style="width: 50%;" alt="">
                                    @else
                                        <img src="{{asset('uploads/logo')}}/{{Auth::user()->company->logo}}" width="80" style="width: 50%;" alt="">
                                    @endif
                                </p>
                                <p class="card-text short-description">{{ $property->short_summary }}</p>
                                <a href="{{route('adminproperty.edit',[$property->id])}}"><button class="btn btn-sm btn-dark">Edit</button></a>
                                <input data-id="{{$property->id}}" name="is_live" class="toggle-live-property" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $property->is_live ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif(count($properties) == 0)
                <div class="col-md-6 offset-md-3">
                    <h2>No properties found</h2>
                    <p>You have not yet added any properties, start by clicking the button below.</p>
                    <a href="{{route('property.create')}}">
                        <button class="btn btn-secondary btn-lg" style="width: 100%;">Add a property</button>
                    </a>
                </div>
            @endif
        </div>
    </div>
    <div class="colorbar mt-5"></div>
@endsection
