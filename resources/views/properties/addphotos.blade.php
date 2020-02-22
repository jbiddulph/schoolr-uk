@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <form action="{{route('property.photo')}}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="card">
                        <div class="card-header">
                            Add Photos for Property {{$property->propname}}
                        </div>
                        <input type="hidden" value="{{$propertyId}}" name="property_id">

                        <div class="card-body">
                            <input type="file" class="form-control" name="property_photo">
                            <br />
                            <button class="btn btn-success float-right" type="submit">Upload Photo</button>
                        </div>
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Property Photos</div>
                    <div class="card-body">
                        @foreach($photos as $propshots)
                            <img src="{{Storage::url($propshots->photo)}}" width="100" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
