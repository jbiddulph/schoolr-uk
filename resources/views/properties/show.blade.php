@extends('layouts.app')

@section('content')
    @if($loggedin)
        <div class="container-fluid" style="border-top:6px solid {{$property->company->primary_color}}"></div>
    @else
        <div class="colorbar"></div>
    @endif
    <div style="width: 100%; height: 300px;">
        {!! Mapper::render() !!}
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">

                    @if(isset($property->propimage))
                        @php
                            $mainphoto = str_replace('public/', 'storage/', $property->propimage)
                        @endphp
                        <div class="mainpic">
                            <img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="Property">
                            <div class="carousel-caption d-none d-md-block">
                                <h3>&pound; {{$property->propcost}}</h3>
                            </div>
                        </div>
                    @endif

                    <div class="card-body">
                        <ul class="icons">
                            @if ($property->bedroom > 0)
                                <li>
                                    <i class="fas fa-bed" aria-hidden="true"></i>
                                    <span>{{$property->bedroom}}</span>
                                </li>
                            @endif
                            @if ($property->bathroom > 0)
                                <li>
                                    <i class="fas fa-bath" aria-hidden="true"></i>
                                    <span>{{$property->bathroom}}</span>
                                </li>
                            @endif
                            @if ($property->reception > 0)
                                <li>
                                    <i class="fas fa-couch" aria-hidden="true"></i>
                                    <span>{{$property->reception}}</span>
                                </li>
                            @endif
                            @if ($property->kitchen > 0)
                                <li>
                                    <i class="fas fa-utensils" aria-hidden="true"></i>
                                    <span>{{$property->kitchen}}</span>
                                </li>
                            @endif
                            @if ($property->garage > 0)
                                <li>
                                    <i class="fas fa-warehouse" aria-hidden="true"></i>
                                    <span>{{$property->garage}}</span>
                                </li>
                            @endif
                            @if ($property->outbuilding > 0)
                                <li>
                                    <i class="fas fa-home" aria-hidden="true"></i>
                                    <span>{{$property->outbuilding}}</span>
                                </li>
                            @endif
                        </ul>
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;{{$property->address}}, {{$property->town}}</p>
{{--                        <p>Created at: {{$property->created_at->diffForHumans()}}</p>--}}
                        <p>Company: <a href="{{route('company.index', [$property->company->id,$property->company->slug])}}">
                                {{$property->company->cname}}
                            </a>
                        </p>
                        <p>Address: {{$property->company->address}}</p>
                        @if(isset($property->company->logo))
                            <p class="card-text"><img src="{{asset('uploads/logo')}}/{{ $property->company->logo }}" width="80" alt=""></p>
                        @else
                            <p class="card-text"><img src="{{asset('uploads/logo')}}/company-logo.png" width="80" alt=""></p>
                        @endif
                    </div>
                </div>
                <br />
                @if(Auth::check()&&Auth::user()->user_type=='seeker')
                    @if(!$property->checkInterest())
                        <interest-component propertyid={{$property->id}}></interest-component>
                    @endif
                        <br/><favproperty-component propertyid={{$property->id}}
                            :favourited={{$property->checkSaved()?'true':'false'}}></favproperty-component>
                @endif
            </div>

            <div class="col-md-8">
                @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{Session::get('message')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{$property->propname}}</div>

                    <div class="card-body">
                        <h3>Summary</h3>
                        <p>{!! $property->summary !!}</p>
                        <h3>Description</h3>
                        <p>{!! $property->description !!}</p>
                        <div id="property{{ $property->id }}" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                @foreach($property->PropertyPhotos as $prophoto)
                                    @php
                                        $photo = str_replace('public/', 'storage/', $prophoto->photo)
                                    @endphp

                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img class="d-block prop_photo" src="/{{ $photo }}" alt="{{$prophoto->photo_title}}">
                                        <div class="carousel-caption d-none d-md-block">
{{--                                            <p>{{$prophoto->photo_title}}</p>--}}
                                        </div>
                                    </div>
                                @endforeach
                                <a class="carousel-control-prev" href="#property{{ $property->id }}" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#property{{ $property->id }}" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <p class="card-text">
{{--                            <i class="fa fa-globe" aria-hidden="true"></i>&nbsp;Date: {{$property->created_at->diffForHumans()}}--}}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @if($loggedin)
        <div class="container-fluid mt-5" style="border-top:6px solid {{$property->company->primary_color}}"></div>
    @else
        <div class="colorbar mt-5"></div>
    @endif
@endsection
