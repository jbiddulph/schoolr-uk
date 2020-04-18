@extends('layouts.list')

@section('content')
    <div class="colorbar"></div>
    <div style="width: 100%; height: 300px;">
        {!! Mapper::render() !!}
    </div>
    <small class="justify-content-center" style="width: 100%; display:flex;">Map markers are shown on paginated search of 52 max per page</small>
    <form action="{{route('venues')}}" name="mapswitchform" id="mapswitchform" method="post" enctype="multipart/form-data">@csrf
        <div class="switchdesc justify-content-center text-center">
            <span>Paginated</span>
            <label class="switch">
                <input name="mapswitch" type="checkbox" {{$checked}}>
                <span class="slider round"></span>
            </label>
            <span>All</span>
        </div>
    </form>
    <div class="container mt-4 welcome">
        <h1>Pubs &amp; Venues</h1>
        <div class="row">
            <ul class="towns-list">
            @foreach($towns as $town)
                <li><h3><a href="{{route('venues.town', [$town->town])}}" class="btn btn-secondary btn-sm">{{$town->town}}</a></h3></li>
            @endforeach
            </ul>
        </div>
        <div class="grid mt-4" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 200 }'>
            @foreach($venueslist as $venue)
                <div class="grid-list">
                    <div class="venue-card card mb-4">
                        @if(isset($venue->photo))
                            @php
                                $mainphoto = str_replace('public/', 'storage/', $venue->photo)
                            @endphp
                            <div class="mainpic">
                                <a href="/venues/{{ str_slug($venue->town)}}/{{str_slug($venue->venuename)}}/{{$venue->id}}"><img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="{{$venue->venuename}}" width="180"></a>
                            </div>
                        @endif
                        <div class="card-body">
                            <strong>{{$venue->postalsearch}}</strong>
                            <h5 class="card-subtitle text-right">{{$venue->venuename}}</h5>
                            <p class="card-text">{{$venue->town}}<br />
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            <div class="offset-md-2 col-md-8 text-center">
                {{$venueslist->links()}}
            </div>
        </div>
    </div>
    <div class="colorbar mt-5"></div>
@endsection
