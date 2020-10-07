@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                    @if(empty(Auth::user()->profile->avatar))
                <img src="{{asset('avatar/company-logo.png')}}" width="100" style="width: 100%;" alt="">
                @else
                    <img src="{{asset('uploads/avatar')}}/{{Auth::user()->profile->avatar}}" width="100" style="width: 100%;" alt="">
                @endif
                <br /><br />
                <form action="{{route('avatar')}}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="card">
                        <div class="card-header">Update Avatar</div>
                        <div class="card-body">
                            <input type="file" class="form-control" name="avatar">
                            <br />
                            <button class="btn btn-success float-right" type="submit">Update Avatar</button>
                            @if($errors->has('avatar'))
                                <div class="error text-danger">{{$errors->first('avatar')}}</div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Update Profile</div>
                    <form action="{{route('profile.create')}}" method="POST">@csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="address_1">Address</label>
                            <input type="text" class="form-control" name="address_1" value="{{Auth::user()->profile->address_1}}">
                            @if($errors->has('address_1'))
                                <div class="error text-danger">{{$errors->first('address_1')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" value="{{Auth::user()->profile->phone_number}}">
                            @if($errors->has('phone_number'))
                                <div class="error text-danger">{{$errors->first('phone_number')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="experience">Experience</label>
                            <textarea name="experience" class="form-control">{{Auth::user()->profile->experience}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <textarea name="bio" class="form-control">{{Auth::user()->profile->bio}}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>
                    </div>
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Your Information</div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{Auth::user()->name}}</p>
                        <p><strong>Address:</strong> {{Auth::user()->profile->address_1}}</p>
                        <p><strong>Phone Number:</strong> {{Auth::user()->profile->phone_number}}</p>
                        <p><strong>Gender:</strong> {{Auth::user()->profile->gender}}</p>
                        <p><strong>Exp:</strong> {{Auth::user()->profile->experience}}</p>
                        <p><strong>Bio:</strong> {{Auth::user()->profile->bio}}</p>
                        <p><strong>Joined on:</strong> {{date('F d Y',strtotime(Auth::user()->created_at))}}</p>

                        @if(!empty(Auth::user()->profile->cover_letter))
                            <p><a href="{{Storage::url(Auth::user()->profile->cover_letter)}}">Cover Letter</a></p>
                            @else
                            <p>Please upload Cover letter</p>
                        @endif
                    </div>
                </div>
                <br />
                <form action="{{route('cover.letter')}}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="card">
                        <div class="card-header">Update Cover Letter</div>
                        <div class="card-body">
                            <input type="file" class="form-control" name="cover_letter">
                            <br />
                            <button class="btn btn-success float-right" type="submit">Update Cover Letter</button>
                            @if($errors->has('cover_letter'))
                                <div class="error text-danger">{{$errors->first('cover_letter')}}</div>
                            @endif
                        </div>
                    </div>
                </form>
                <br />
                <form action="{{route('identification')}}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="card">
                        <div class="card-header">Update Identification</div>
                        <div class="card-body">
                            <input type="file" class="form-control" name="identification">
                            <br />
                            <button class="btn btn-success float-right" type="submit">Update Identification</button>
                            @if($errors->has('identification'))
                                <div class="error text-danger">{{$errors->first('identification')}}</div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
