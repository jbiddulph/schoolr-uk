@extends('layouts.app')

@section('content')
    <div class="colorbar"></div>
    <div class="container mt-4">
        <h1>Venue Administration - <a href="/admin">Admin</a></h1>
        <a href="{{route('adminvenue.create')}}">
            <button class="btn btn-secondary">Add Venue</button>
        </a>
{{--        <a href="{{route('venues.addressLabels', ['town',''])}}">--}}
{{--            <button class="btn btn-secondary">Add Venue</button>--}}
{{--        </a>--}}

        <div class="row">
            @if(count($venues) > 0)
                @foreach($venues as $venue)
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <div id="venue{{ $venue->id }}">
                                <div role="listbox">
                                    @if(isset($venue->photo))
                                        @php
                                            $mainphoto = str_replace('public/', 'storage/', $venue->photo)
                                        @endphp
                                        <div class="mainpic">
                                            <div class="edit-photo"><input data-id="{{$venue->id}}" name="is_live" class="toggle-live-venue" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $venue->is_live ? 'checked' : '' }}></div>
                                            <img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="Venue">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{route('adminvenue.edit',[$venue->id])}}"><h3 class="card-title">{{$venue->school}}</h3>
                                <p class="card-text short-description">
                                    {{$venue->address_1}}<br />
                                    {{$venue->town}}
                                </p>
                                </a>
                                @if(Storage::url('letters/'. $venue->town .'/'.$venue->school.'.pdf'))
                                    <a href="{{Storage::url('letters/'. $venue->town .'/'.$venue->school.'.pdf')}}">View Letter</a>
                                @endif
                                <img src="{{url('qrcodes/'. $venue->town .'/venues/qrcode-'.$venue->id.'.png')}}" width="150" />
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
