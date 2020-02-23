@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Properties</h2>













        <div class="row">
                @foreach($properties as $property)
                    <div class="col-md-3">
                        <div class="card">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="https://dummyimage.com/260x200/000/fff.jpg&text=awaiting+image" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="https://dummyimage.com/260x200/000/fff.jpg&text=awaiting+image" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="https://dummyimage.com/260x200/000/fff.jpg&text=awaiting+image" alt="Third slide">
                                    </div>


                                    @foreach($property->PropertyPhotos as $prophotos)
                                        @if($prophotos->property_id == $property->id)
                                            <div class="carousel-item active">
                                                <div style="display: none"><?= $photos = str_replace('public/', 'storage/', $prophotos->photo)?></div>
                                                <img class="card-img-top" src="{{asset($photos)}}" alt="First slide">
                                            </div>
                                        @endif
                                    @endforeach


                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>


                            <div class="card-body">
                                <h4 class="card-title">{{$property->propname}}</h4>
                                <h5 class="card-subtitle text-right">{{$property->propcost}}</h5>
                                <p class="card-text"><img src="{{asset('avatar/mark-oliver.png')}}" width="80" alt=""></p>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <p class="card-text">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;{{$property->address}}, {{$property->city}}
                                    <i class="fa fa-money" aria-hidden="true"></i>&nbsp;{{$property->propcost}}
                                    <i class="fa fa-globe" aria-hidden="true"></i>&nbsp;Date: {{$property->created_at->diffForHumans()}}
                                </p>
                                <a class="btn btn-success btn-sm" href="{{route('properties.show',[$property->id, $property->slug])}}">Enquire</a>
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
