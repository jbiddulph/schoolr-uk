@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="company-profile">
                    @if(empty(Auth::user()->company->cover_photo))
                        <img src="{{asset('/uploads/coverphoto/default.jpg')}}" style="width: 100%;" alt="Company cover">
                    @else
                        <img src="{{asset('/uploads/coverphoto/'.$company->cover_photo)}}" style="width: 100%;" alt="Company cover">
                    @endif

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="company-desc">
                    @if(empty(Auth::user()->company->logo))
                       <img src="{{asset('/uploads/logo/default_logo.png')}}" style="width: 100%;" alt="Company cover">
                    @else
                       <img src="{{asset('/uploads/logo/'.$company->logo)}}" style="width: 100%;" alt="Company cover">
                    @endif
                    <p>{{$company->description}}</p>
                    <h1>{{$company->cname}}</h1>
                    <p>Slogan: {{$company->slogan}}, address: {{$company->address}}, phone: {{$company->telephone}} website: {{$company->website}}</p>
                </div>
            </div>
            <div class="col-md-10">

            </div>
        </div>
            <table class="table">
                <thead>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                </thead>
                <tbody>
                @foreach($company->properties as $property)
                    <tr>
                        <td><img src="{{asset('avatar/mark-oliver.png')}}" width="80" alt=""></td>
                        <td><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;{{$property->address}}, {{$property->city}}</td>
                        <td><i class="fa fa-money" aria-hidden="true"></i>&nbsp;{{$property->propcost}}</td>
                        <td><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;Date: {{$property->created_at->diffForHumans()}}</td>
                        <td><a href="{{route('properties.show',[$property->id, $property->slug])}}"><button class="btn btn-success btn-sm">Enquire</button></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

@endsection
