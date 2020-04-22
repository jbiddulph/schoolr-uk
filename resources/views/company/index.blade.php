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
                <div class="bgcover" style="background-image: url('{{asset('/uploads/coverphoto/default.jpg')}}'); width:100%; min-height:350px;">
                    <div class="company-logo">
                        @if(empty($company->logo))
                            <img src="{{asset('/uploads/logo/company-logo.png')}}" style="height: 110px" alt="Company Logo">
                        @else
                            <img src="{{asset('/uploads/logo/'.$company->logo)}}" style="height: 110px" alt="Company Logo">
                        @endif
                    </div>
{{--                    <img src="{{asset('/uploads/coverphoto/default.jpg')}}" style="width: 100%;" alt="Company cover">--}}
                    <h1>{{$company->cname}}</h1>
                    <h2>{{$company->slogan}}</h2>
                </div>
            @else
                <div class="bgcover" style="background-image: url('{{asset('/uploads/coverphoto/'.$company->cover_photo)}}'); width:100%; min-height:450px; background-size: cover;">
                    <div class="company-logo">
                        @if(empty($company->logo))
                            <img src="{{asset('/uploads/logo/company-logo.png')}}" style="height: 110px" alt="Company Logo">
                        @else
                            <img src="{{asset('/uploads/logo/'.$company->logo)}}" style="height: 110px" alt="Company Logo">
                        @endif
                    </div>
                    {{--                    <img src="{{asset('/uploads/coverphoto/default.jpg')}}" style="width: 100%;" alt="Company cover">--}}
                    <h1>{{$company->cname}}</h1>
                    <h2>{{$company->slogan}}</h2>
                    <p>Address: {{$company->address}}, <br />phone: {{$company->telephone}} <br />website: {{$company->website}}</p>
                </div>
            @endif
        </div>
    </div>
    <div class="container">
        <div class="container-fluid mt-4 welcome">
            <h1>{{$company->cname}} - Property List</h1>
            <p>{{$company->description}}</p>
            <div class="row mt-4">
                @foreach($company->properties as $property)
                    <div class="col-md-3">
                        <div class="property-card card mb-4">

                            @if(isset($property->propimage))
                                @php
                                    $mainphoto = str_replace('public/', 'storage/', $property->propimage)
                                @endphp
                                <div class="mainpic">
                                    <a href="{{route('properties.show',[$property->id, $property->slug])}}"><img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="{{$property->propname}}"></a>
                                    <h5 class="card-subtitle text-right">&pound;&nbsp;{!! number_format($property->propcost); !!}</h5>
                                </div>
                            @endif
                            <div class="card-body">
                                <h4 class="card-title"><a href="{{route('properties.show',[$property->id, $property->slug])}}">{{$property->propname}}</a></h4>
                                <p class="card-text short-description">{{ $property->short_summary }}</p>
                                <div class="text-right">
                                    <a class="btn btn-primary btn-md" href="{{route('properties.show',[$property->id, $property->slug])}}">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex flex-row-reverse">

{{--                {{$company->properties->appends(Illuminate\Support\Facades\Request::except('page'))->links()}}--}}

            </div>
        </div>
        </div>
    <div class="colorbar mt-5"></div>
@endsection
