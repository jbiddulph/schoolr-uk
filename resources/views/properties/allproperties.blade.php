@extends('layouts.app')

@section('content')
    @if($loggedin)
        <div class="container-fluid" style="border-top:6px solid {{Auth::user()->company->primary_color}}"></div>
    @else
        <div class="colorbar"></div>
    @endif
    <div style="width: 100%; height: 300px;">
        {!! Mapper::render() !!}
    </div>
    <div class="container mt-4 welcome">
        <h1>Properties</h1>
        <div class="row">
            <div class="form-inline">
                <div class="form-group mr-2">
                    <label>Search</label>
                    <input type="text" name="propname" class="form-control">
                </div>
                <div class="form-group mr-2">
                    <label>Beds</label>
                    <input type="text" name="bedroom" class="form-control">
                </div>
                <div class="form-group mr-2">
                    <label>Property Type</label>
                    <input type="text" name="proptype" class="form-control">
                </div>
                <div class="form-group mr-2">
                    <label>Category</label>
                    <select name="category_id" class="form-control" id="category_id">
                        <option value="">Please select</option>
                        @foreach(App\Category::all() as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mr-2">
                    <label>Town</label>
                    <input type="text" name="town" class="form-control">
                </div>
            </div>
        </div>
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
                            <h5 class="card-subtitle text-right">&pound;{{$property->propcost}}</h5>
                            <p class="card-text short-description">{{$property->description}}</p>
                            <a class="btn btn-primary btn-sm" href="{{route('properties.show',[$property->id, $property->slug])}}">Enquire</a>
                        </div>
                    </div>
                </div>
            @endforeach
            {{$properties->links()}}
        </div>
    </div>
    <div class="colorbar mt-5"></div>
@endsection
