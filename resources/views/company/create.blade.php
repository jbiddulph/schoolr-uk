@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="border-top:6px solid {{Auth::user()->company->primary_color}}"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @if(empty(Auth::user()->company->logo))
                    <img src="{{asset('avatar/company-logo.png')}}" width="100" style="width: 100%;" alt="">
                @else
                    <img src="{{asset('uploads/logo')}}/{{Auth::user()->company->logo}}" style="width: 100%;" alt="">
                @endif
                <div class="update-company-logo">
                    <form action="{{route('company.logo')}}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="card">
                            <div class="card-body">
                                <input type="file" class="form-control" name="company_logo">
                                @if($errors->has('company_logo'))
                                    <div class="error text-danger">{{$errors->first('company_logo')}}</div>
                                @endif
                                <br />
                                <button class="btn btn-dark float-right" type="submit">Update Company Logo</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="update-company-branding mt-3">
                    <form action="{{route('company.branding')}}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="card">
                            <div class="card-header">Update branding</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="primary">Primary Color</label>
                                    <input type="text" class="colorpicker1 form-control" name="primary_color" id="primary" placeholder="#000000" value="{{old('primary_color')}}" class="form-control">
                                    @if($errors->has('primary_color'))
                                        <div class="error text-danger">{{$errors->first('primary_color')}}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="secondary">Secondary Color</label>
                                    <input type="text" class="colorpicker2 form-control" name="secondary_color" id="secondary" placeholder="#ffffff" value="{{old('secondary_color')}}" class="form-control">
                                    @if($errors->has('secondary_color'))
                                        <div class="error text-danger">{{$errors->first('secondary_color')}}</div>
                                    @endif
                                </div>
                                <button class="btn btn-dark float-right" type="submit">Update Branding</button>

                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <div class="col-md-5">
                @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        {{Session::get('message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card mt-4">
                    <div class="card-header">Update Company Information</div>
                    <form action="{{route('company.store')}}" method="POST">@csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="address_1">Address</label>
                                <input type="text" class="form-control" name="address_1" value="{{Auth::user()->company->address_1}}">
                                @if($errors->has('address_1'))
                                    <div class="error text-danger">{{$errors->first('address_1')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="telephone">Telephone</label>
                                <input type="text" class="form-control" name="telephone" value="{{Auth::user()->company->telephone}}">
                                @if($errors->has('telephone'))
                                    <div class="error text-danger">{{$errors->first('telephone')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="text" class="form-control" name="website" value="{{Auth::user()->company->website}}">
                                @if($errors->has('website'))
                                    <div class="error text-danger">{{$errors->first('website')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="slogan">Slogan</label>
                                <input type="text" class="form-control" name="slogan" value="{{Auth::user()->company->slogan}}">
                                @if($errors->has('slogan'))
                                    <div class="error text-danger">{{$errors->first('slogan')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="slogan">Description</label>
                                <textarea name="description" class="form-control">{{Auth::user()->company->description}}</textarea>
                                @if($errors->has('description'))
                                    <div class="error text-danger">{{$errors->first('description')}}</div>
                                @endif
                            </div>


                            <div class="form-group">
                                <button class="btn btn-dark" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mt-4">
                    <div class="card-header">Your Company</div>
                    <div class="card-body">
                        <p>Company Name: {{Auth::user()->company->cname}}</p>
                        <p>Address: {{Auth::user()->company->address_1}}</p>
                        <p>Phone: {{Auth::user()->company->telephone}}</p>
                        <p>Website: <a href="{{Auth::user()->company->website}}">{{Auth::user()->company->website}}</a></p>
                        <p>Slogan: {{Auth::user()->company->slogan}}</p>
                        <p><a href="company/{{Auth::user()->company->slug}}">View</a></p>
                    </div>
                </div>
                <form action="{{route('cover.photo')}}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="card mt-3">
                        <div class="card-header">Update Cover Photo</div>
                        <div class="card-body">
                            <input type="file" class="form-control" name="cover_photo">
                            @if($errors->has('cover_photo'))
                                <div class="error text-danger">{{$errors->first('cover_photo')}}</div>
                            @endif
                            <br />
                            <button class="btn btn-dark float-right" type="submit">Update Cover Photo</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-4" style="border-top:6px solid {{Auth::user()->company->primary_color}}"></div>
@endsection
