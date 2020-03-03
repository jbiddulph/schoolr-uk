@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Properties</h2>
        <div class="row">

            @foreach($properties as $property)
                <div class="col-md-3">
                    <div class="card">
                        <div id="property{{ $property->id }}">
                            <div role="listbox">
                                @if(isset($property->propimage))
                                    @php
                                        $mainphoto = str_replace('public/', 'storage/', $property->propimage)
                                    @endphp
                                    <div class="mainpic">
                                        <img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="Property">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">{{$property->propname}}</h4>
                            <h5 class="card-subtitle text-right">{{$property->propcost}}</h5>
                            <p class="card-text">
                                @if(empty(Auth::user()->company->logo))
                                    <img src="{{asset('avatar/mark-oliver.png')}}" width="80" style="width: 50%;" alt="">
                                @else
                                    <img src="{{asset('uploads/logo')}}/{{Auth::user()->company->logo}}" width="80" style="width: 50%;" alt="">
                                @endif
                            </p>
                            <p class="card-text">{{$property->description}}</p>
                            <p class="card-text">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;{{$property->address}}, {{$property->city}}
                                <i class="fa fa-money" aria-hidden="true"></i>&nbsp;{{$property->propcost}}
                                <i class="fa fa-globe" aria-hidden="true"></i>&nbsp;Date: {{$property->created_at->diffForHumans()}}
                            </p>
                            <a class="btn btn-success btn-sm" href="{{route('properties.show',[$property->id, $property->slug])}}">Enquire</a>
                            <a href="{{route('property.edit',[$property->id])}}"><button class="btn btn-sm btn-dark">Edit</button></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
