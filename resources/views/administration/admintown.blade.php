@extends('layouts.app')

@section('content')
    <div class="colorbar"></div>
    <div class="container mt-4">
        <h1>Event Administration - <a href="/admin">Admin</a></h1>
        <a href="{{route('adminevent.create')}}">
            <button class="btn btn-secondary">Add Event</button>
        </a>
        <a href="{{route('events.deleted')}}">
            <button class="btn btn-secondary">Deleted Events</button>
        </a>
        <div class="row">
            @if(count($towns) > 0)
                @foreach($towns as $town)
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <div id="" class="card-header">
                                {{ $town->town }}
                            </div>
                            <div class="card-body">
                                <a href="{{route('venues.addressLabels', [$town->town])}}"><h3 class="card-title"> save labels PDF for {{ $town->town }}</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="colorbar mt-5"></div>
@endsection
