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
    <div class="container-fluid welcome search-block">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('allproperties')}}" method="GET">
                    <div class="form-inline">
                        <div class="form-group mr-2">
                            <label>Search:</label>
                            <input type="text" name="propname" class="form-control ml-2">
                        </div>
                        <div class="form-group mr-2">
                            <label>Max Beds:</label>
                            <select name="bedroom" class="form-control ml-2" id="bedroom">
                                <option value="">Please Select</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label>Type:</label>
                            <select name="proptype_id" class="form-control @error('proptype_id') is-invalid @enderror ml-2" id="proptype_id">
                                <option value="">Please select</option>
                                @foreach(App\PropertyType::all() as $propType)
                                    <option value="{{$propType->id}}">{{$propType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label>Status:</label>
                            <select name="category_id" class="form-control ml-2" id="category_id">
                                <option value="">Please select</option>
                                @foreach(App\Category::all() as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label>Town:</label>
                            <select name="town" class="form-control ml-2" id="category_id">
                                <option value="">Please select</option>
                                @foreach(App\Property::select('town')->distinct()->get() as $town)
                                    <option value="{{$town->town}}">{{$town->town}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <input type="submit" value="search" class="btn-primary btn btn-md">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-4 welcome">
        <h1>Property List</h1>
        <div class="row mt-4">
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
                            <p class="card-text short-description">{!! $property->description !!}</p>
                            <div class="text-right">
                                <a class="btn btn-primary btn-md" href="{{route('properties.show',[$property->id, $property->slug])}}">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex flex-row-reverse">

                {{$properties->appends(Illuminate\Support\Facades\Request::except('page'))->links()}}

        </div>
    </div>
    <div class="colorbar mt-5"></div>
@endsection
