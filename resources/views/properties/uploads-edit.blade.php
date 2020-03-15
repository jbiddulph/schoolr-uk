@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="border-top:6px solid {{Auth::user()->company->primary_color}}"></div>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>{{$property->propname}}</h2>
                        <p>Property Image</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form action="{{route('property.propImageUpdate', [$property->id])}}" method="POST" enctype="multipart/form-data">@csrf
                                @if(isset($property->propimage))
                                    @php
                                        $mainphoto = str_replace('public/', 'storage/', $property->propimage)
                                    @endphp
                                    <div class="mainpic">
                                        <img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="Property">
                                    </div>
                                @endif
                                <input type="file" class="form-control" name="propimage">
                                <br />
                                <button class="btn btn-dark float-right" type="submit">Update Property Image</button>
                                @if($errors->has('propimage'))
                                    <div class="error text-danger">{{$errors->first('propimage')}}</div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-4" style="border-top:6px solid {{Auth::user()->company->primary_color}}"></div>
@endsection
