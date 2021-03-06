@extends('layouts.app')

@section('content')

    <div class="colorbar"></div>
    <div style="height: 300px;" class="header-img">
        @if(isset($venue->photo))
            @php
                $mainphoto = str_replace('public/', 'storage/', $venue->photo)
            @endphp
            <div class="mainpic" style="background-image: url(/{{ $mainphoto }})">
                {{--                <img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="{{$thevenue->school}}">--}}
            </div>
        @endif
        <div class="qr-code" style="text-align:center; padding-bottom: 10px;">
            <h3>Customer Tag-in</h3>
            <img src="{{url('qrcodes/'. $venue->town .'/customers/tagin-'.$venue->id.'.png')}}" width="180" />
        </div>
    </div>
    <div class="container mt-4">
        @if(Auth::user()->user_type == 'admin')
            <h1>Edit Venue | <a href="/admin">Admin</a>
                   | <a href="/admin/venue">Edit Venue List</a>
            </h1>
            <div class="text-right"><a href="/venues/{{$venue->town}}/{{$venue->school}}/{{$venue->id}}" class="btn btn-primary">View {{$venue->school}}</a></div>
        @else
            <h1>Edit Venue </h1>{{ $venue->byb_type }}
            <div class="text-right"><a href="/venues/{{$venue->town}}/{{$venue->school}}/{{$venue->id}}" class="btn btn-primary">View {{$venue->school}}</a></div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(!auth()->user()->subscribed('main') || Auth::user()->user_type != 'admin')
{{--                    <p>subscribed</p>--}}
                @else
{{--                    <p>Not subscribed</p>--}}
                @endif
                <div class="card">
                    <div class="card-header"><h2>{{ $venue->school }}</h2></div>
                    <div class="card-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @endif
                            @if(auth()->user()->subscribed('main'))
                                <form action="{{route('venue.update', [$venue->id])}}" method="post" enctype="multipart/form-data">@csrf
                            @else(Auth::user()->user_type != 'admin')
                                <form action="{{route('adminvenue.update', [$venue->id])}}" method="post" enctype="multipart/form-data">@csrf
                            @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="propname">Venue Name</label>
                                        <input type="text" name="school" class="form-control @error('school') is-invalid @enderror" value="{{ $venue->school }}">
                                        @error('school')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="byb_type">Venue Type</label>
                                        <input type="text" name="byb_type" class="form-control @error('byb_type') is-invalid @enderror" value="{{ $venue->byb_type }}">
                                        @error('byb_type')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address_1">Venue Address</label>
                                        <input type="text" name="address_1" class="form-control @error('address_1') is-invalid @enderror" value="{{ $venue->address_1 }}">
                                        @error('address_1')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="propname">Address 2</label>
                                        <input type="text" name="address_2" class="form-control @error('address_2') is-invalid @enderror" value="{{ $venue->address_2 }}">
                                        @error('address_2')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="byb_type">Town</label>
                                        <input type="text" name="town" class="form-control @error('town') is-invalid @enderror" value="{{ $venue->town }}">
                                        @error('town')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address_1">County</label>
                                        <input type="text" name="county" class="form-control @error('county') is-invalid @enderror" value="{{ $venue->county }}">
                                        @error('county')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="propname">Post Code</label>
                                        <input type="text" name="postcode" class="form-control @error('postcode') is-invalid @enderror" value="{{ $venue->postcode }}">
                                        @error('postcode')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
{{--                                    <div class="form-group">--}}
{{--                                        <label for="byb_type">Postal Search</label>--}}
{{--                                        <input type="text" name="postalsearch" class="form-control @error('postalsearch') is-invalid @enderror" value="{{ $venue->postalsearch }}">--}}
{{--                                        @error('postalsearch')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address_1">Telephone</label>
                                        <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ $venue->telephone }}">
                                        @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="propname">Latitude</label>
                                        <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror" value="{{ $venue->latitude }}">
                                        @error('latitude')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="byb_type">Longitude</label>
                                        <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror" value="{{ $venue->longitude }}">
                                        @error('longitude')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address_1">Website</label>
                                        <input type="text" name="website" class="form-control @error('website') is-invalid @enderror" value="{{ $venue->website }}">
                                        @error('website')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Save Venue</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    @if(isset($venue->photo))
                        @php
                            $mainphoto = str_replace('public/', 'storage/', $venue->photo)
                        @endphp
                        <div class="mainpic">
                            <img class="card-img-top" src="/{{ $mainphoto }}" alt="Venue picture">
                        </div>
                    @endif
                    <div class="card-body">
                        @if(auth()->user()->subscribed('main'))
                        <form action="{{route('venue.venueImageUpdate', [$venue->id])}}" method="POST" enctype="multipart/form-data">@csrf
                        @else(Auth::user()->user_type === 'admin')
                        <form action="{{route('adminvenue.venueImageUpdate', [$venue->id])}}" method="POST" enctype="multipart/form-data">@csrf
                            @endif
                            <h5 class="card-title">{{$venue->school}}</h5>
                            <p class="card-text">{{$venue->address_1}}, <br />
                                {{$venue->address_2}}<br />
                                {{$venue->town}}<br />
                                {{$venue->county}}
                            </p>
                            <input type="file" class="form-control" name="photo">
                            <br />
                            <button class="btn btn-dark float-right" type="submit">Update Venue Image</button>
                            @if($errors->has('photo'))
                                <div class="error text-danger">{{$errors->first('photo')}}</div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="colorbar"></div>

@endsection
