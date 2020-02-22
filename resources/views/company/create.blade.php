@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @if(empty(Auth::user()->profile->avatar))
                    <img src="{{asset('avatar/mark-oliver.png')}}" width="100" style="width: 100%;" alt="">
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
                            <button class="btn btn-success float-right" type="submit">Update Cover Letter</button>
                            @if($errors->has('avatar'))
                                <div class="error text-danger">{{$errors->first('avatar')}}</div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Update Company Information</div>
                    <form action="{{route('profile.create')}}" method="POST">@csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                            <div class="form-group">
                                <label for="telephone">Telephone</label>
                                <input type="text" class="form-control" name="telephone">
                            </div>
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="text" class="form-control" name="website">
                            </div>
                            <div class="form-group">
                                <label for="slogan">Slogan</label>
                                <input type="text" class="form-control" name="slogan">
                            </div>
                            <div class="form-group">
                                <label for="slogan">Description</label>
                                <textarea name="description" class="form-control"></textarea>
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
                    <div class="card-header">Your Company</div>
                    <div class="card-body">
                        details
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
            </div>
        </div>
    </div>
@endsection
