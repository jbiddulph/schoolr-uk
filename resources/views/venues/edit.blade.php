@extends('layouts.app')

@section('content')
    @if(Auth::user()->user_type != 'admin')
    <div class="container-fluid" style="border-top:6px solid {{Auth::user()->company->primary_color}}"></div>
    @endif
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(Auth::user()->user_type == 'admin')
                    <a href="/admin/venue">Edit Venue List</a>
                @endif
                <div class="card">
                    <div class="card-header"><h2>Venue Update</h2></div>
                    <div class="card-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @endif
                        @if(Auth::user()->user_type != 'admin')
                        <form action="{{route('venue.update', [$venue->id])}}" method="post" enctype="multipart/form-data">@csrf
                        @else
                        <form action="{{route('adminvenue.update', [$venue->id])}}" method="post" enctype="multipart/form-data">@csrf
                        @endif
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="propname">Venue Name</label>
                                        <input type="text" name="venuename" class="form-control @error('venuename') is-invalid @enderror" value="{{ $venue->venuename }}">
                                        @error('venuename')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="venuetype">Venue Type</label>
                                        <input type="text" name="venuetype" class="form-control @error('venuetype') is-invalid @enderror" value="{{ $venue->venuetype }}">
                                        @error('venuetype')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Venue Address</label>
                                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ $venue->address }}">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h2>Venue Photo</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <p>{{$venue->venuename}}</p>
                            <form action="{{route('adminvenue.venueImageUpdate', [$venue->id])}}" method="POST" enctype="multipart/form-data">@csrf
                                @if(isset($venue->photo))
                                    @php
                                        $mainphoto = str_replace('public/', 'storage/', $venue->photo)
                                    @endphp
                                    <div class="mainpic">
                                        <img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="Property">
                                    </div>
                                @endif
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
    </div>
    @if(Auth::user()->user_type != 'admin')
    <div class="container-fluid mt-4" style="border-top:6px solid {{Auth::user()->company->primary_color}}"></div>
    @endif
@endsection
