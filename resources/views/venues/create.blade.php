@extends('layouts.app')

@section('content')
    @if(Auth::user()->user_type != 'admin')
    <div class="container-fluid" style="border-top:6px solid {{Auth::user()->company->primary_color}}"></div>
    @endif
    <div class="container mt-4">
        @if(Auth::user()->user_type == 'admin')
            <a href="/admin/venue">Edit Venue List</a>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Venue Create</h2></div>
                    <div class="card-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @endif
                            <form action="{{route('adminvenue.store')}}" method="post" enctype="multipart/form-data">@csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="photo">Venue Photo</label>
                                        <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">
                                        <br />
                                        @if($errors->has('photo'))
                                            <div class="error text-danger">{{$errors->first('photo')}}</div>
                                        @endif
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="propname">Venue Name</label>
                                        <input type="text" name="venuename" class="form-control @error('venuename') is-invalid @enderror">
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
                                        <input type="text" name="venuetype" class="form-control @error('venuetype') is-invalid @enderror">
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
                                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror">
                                        @error('address')
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
                                        <input type="text" name="address2" class="form-control @error('address2') is-invalid @enderror">
                                        @error('address2')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="venuetype">Town</label>
                                        <input type="text" name="town" class="form-control @error('town') is-invalid @enderror">
                                        @error('town')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">County</label>
                                        <input type="text" name="county" class="form-control @error('county') is-invalid @enderror">
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
                                        <input type="text" name="postcode" class="form-control @error('postcode') is-invalid @enderror">
                                        @error('postcode')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="venuetype">Postal Search</label>
                                        <input type="text" name="postalsearch" class="form-control @error('postalsearch') is-invalid @enderror">
                                        @error('postalsearch')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Telephone</label>
                                        <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror">
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
                                        <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror">
                                        @error('latitude')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="venuetype">Longitude</label>
                                        <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror">
                                        @error('longitude')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Website</label>
                                        <input type="text" name="website" class="form-control @error('website') is-invalid @enderror">
                                        @error('website')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 offset-md-8">
                                    <button type="submit" class="btn btn-block btn-primary">Save Venue</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->user_type != 'admin')
    <div class="container-fluid mt-4" style="border-top:6px solid {{Auth::user()->company->primary_color}}"></div>
    @endif
@endsection
