@extends('layouts.app')

@section('content')
    <div class="colorbar"></div>
    <div class="container mt-4">
        <h1>Venue Administration - <a href="/admin">Admin</a></h1>
        <div class="row">
            @if(count($venues) > 0)
                @foreach($venues as $venue)
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <div id="property{{ $venue->id }}">
                                <div role="listbox">
                                    @if(isset($venue->photo))
                                        @php
                                            $mainphoto = str_replace('public/', 'storage/', $venue->photo)
                                        @endphp
                                        <div class="mainpic">
                                            <div class="edit-photo"><a href="{{route('adminproperty.uploadsedit',[$venue->id])}}"><i class="fas fa-camera fa-2x"></i></a></div>
                                            <img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="Property">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('adminvenue.edit',[$venue->id])}}"><h4 class="card-title">{{$venue->venuename}}</h4>
                                <h5 class="card-subtitle text-right">{{$venue->venuetype}}</h5>
                                <p class="card-text short-description">
                                    {{$venue->address}}<br />
                                    {{$venue->town}}
                                </p>
                                <input data-id="{{$venue->id}}" name="is_live" class="toggle-live-venue" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $venue->is_live ? 'checked' : '' }}></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        {{ $venues->links() }}
    </div>
    <div class="colorbar mt-5"></div>
@endsection
