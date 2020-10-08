@extends('layouts.list')

@section('content')
    <div class="colorbar"></div>
    <div style="width: 100%; height: 300px;">
{{--        {!! Mapper::render() !!}--}}
    </div>
    <small class="justify-content-center" style="width: 100%; display:flex;">Map markers are shown on paginated search of 52 max per page</small>
{{--    <form action="{{route('venues')}}" name="mapswitchform" id="mapswitchform" method="post" enctype="multipart/form-data">@csrf--}}
{{--        <div class="switchdesc justify-content-center text-center">--}}
{{--            <span>Paginated</span>--}}
{{--            <label class="switch">--}}
{{--                <input name="mapswitch" type="checkbox" {{$checked}}>--}}
{{--                <span class="slider round"></span>--}}
{{--            </label>--}}
{{--            <span>All</span>--}}
{{--        </div>--}}
{{--    </form>--}}
    <div class="container mt-4 welcome">
        <h1>Pubs &amp; Venues</h1>
        <div class="row">
            <ul class="towns-list">
            @foreach($towns as $town)
                <li><h3><a href="{{route('venues.town', [$town->town])}}" class="btn btn-secondary btn-lg hvr-grow-rotate">{{$town->town}}</a></h3></li>
            @endforeach
            </ul>
        </div>
        <div class="row">
{{--            @foreach($venueslist as $venue)--}}
{{--                <div class="col-md-2 col-sm-12">--}}
{{--                    <a href="/venues/{{ str_slug($venue->town)}}/{{str_slug($venue->school)}}/{{$venue->id}}">--}}
{{--                        <div class="venue-card card mb-4">--}}
{{--                        @if(isset($venue->photo))--}}
{{--                            @php--}}
{{--                                $mainphoto = str_replace('public/', 'storage/', $venue->photo)--}}
{{--                            @endphp--}}
{{--                            <div class="mainpic" style="background-image: url('/\{{ $mainphoto }}'); background-repeat: no-repeat;     background-size: cover;--}}
{{--                                display: block;--}}
{{--                                width: 100%;--}}
{{--                                height: 120px;">--}}

{{--                                    --}}{{--                                    <img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="{{$venue->school}}" width="180">--}}

{{--                                <h2 class="card-subtitle">{{$venue->school}}</h2>--}}

{{--                            </div>--}}
{{--                        @endif--}}
{{--                        <div class="card-body">--}}
{{--                            --}}{{--                        <h4 class="card-title"><a href="{{route('venues.show',[$venue->id, $venue->slug])}}">{{$venue->propname}}</a></h4>--}}

{{--                            <div class="card-text">--}}
{{--                                <div class="address_1">{{$venue->address_1}}<br />--}}
{{--                                    @if($venue->address_2 != '')--}}
{{--                                        {{$venue->address_2}}<br />--}}
{{--                                    @endif--}}
{{--                                    {{$venue->town}}<br />--}}
{{--                                    {{$venue->county}}<br />--}}
{{--                                    {{$venue->postcode}}</div>--}}
{{--                                <span><a href="tel:{{$venue->telephone}}"><i class="fas fa-2x fa-phone-alt"></i></a></span>--}}
{{--                            </div>--}}
{{--                            --}}{{--                            <a class="btn btn-primary btn-sm" href="{{route('properties.show',[$venue->id, $venue->slug])}}">Enquire</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            @endforeach--}}
        </div>
        <div class="row justify-content-center">
            <div class="offset-md-2 col-md-8 text-center">
                {{$venueslist->links()}}
            </div>
        </div>
    </div>
    <div class="colorbar mt-5"></div>
@endsection
