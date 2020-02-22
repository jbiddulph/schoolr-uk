@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="company-profile">
                <img src="{{asset($company->cover_photo)}}" style="width: 100%;" alt="Company cover">
                <div class="company-desc">
                    <img src="{{asset($company->logo)}}" style="width: 100%;" alt="Company cover">
                    <p>{{$company->description}}</p>
                    <h1>{{$company->cname}}</h1>
                    <p>Slogan: {{$company->slogan}}, address: {{$company->address}}, phone: {{$company->telephone}} website: {{$company->website}}</p>
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
    </div>
@endsection
