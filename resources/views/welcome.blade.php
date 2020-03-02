@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Properties</h2>
        <div class="row">
                @foreach($properties as $property)
                    <div class="col-md-3">
                        <div class="card">
                            <div id="property{{ $property->id }}" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" role="listbox">
                                    @foreach($property->PropertyPhotos as $prophoto)
                                        @php
                                            $photo = str_replace('public/', 'storage/', $prophoto->photo)
                                        @endphp
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img class="d-block img-fluid prop_photo" src="{{ $photo }}" alt="{{$prophoto->photo_title}}">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h3>{{$prophoto->photo_title}}</h3>
                                                <p>and this is the photo description</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

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
                    </div>
                @endforeach
        </div>
    </div>
@endsection
<style>
    .fa {
        color: #0E9A00;
    }
</style>
