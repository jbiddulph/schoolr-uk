@extends('layouts.app')

@section('content')
    <div class="container-fluid company-profile" style="border-top:6px solid {{$company->primary_color}}">
        <div class="cover-photo">
            <div class="company-logo">
                @if(empty($company->logo))
                    <img src="{{asset('/uploads/logo/company-logo.png')}}" style="height: 110px" alt="Company Logo">
                @else
                    <img src="{{asset('/uploads/logo/'.$company->logo)}}" style="height: 110px" alt="Company Logo">
                @endif
            </div>
            @if(empty($company->cover_photo))
                <img src="{{asset('/uploads/coverphoto/default.jpg')}}" style="width: 100%;" alt="Company cover">
            @else
                <img src="{{asset('/uploads/coverphoto/'.$company->cover_photo)}}" style="width: 100%;" alt="Company cover">
            @endif
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="company-desc">
                    <p>{{$company->description}}</p>
                    <h1>{{$company->cname}}</h1>
                    <p>Slogan: {{$company->slogan}}, address: {{$company->address}}, phone: {{$company->telephone}} website: {{$company->website}}</p>
                </div>
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
                        <td>
                            <p class="card-text">
                                <img src="{{asset('uploads/logo')}}/{{$property->logo}}" height="80" alt="">
                            </p>
                        </td>
                        <td><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;{{$property->address}}, {{$property->city}}</td>
                        <td><i class="fa fa-money" aria-hidden="true"></i>&nbsp;{!! number_format($property->propcost); !!}</td>
                        <td><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;Date: {{$property->created_at->diffForHumans()}}</td>
                        <td><a href="{{route('properties.show',[$property->id, $property->slug])}}"><button class="btn btn-primary btn-sm">Enquire</button></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    <div class="colorbar mt-5"></div>
@endsection
