@extends('layouts.app')

@section('content')
    <div class="colorbar"></div>
    <div class="container mt-4 townadmin">
        <h1>Town Administration - <a href="/admin">Admin</a></h1>
        <div class="row">
            @if(count($towns) > 0)
                @foreach($towns as $town)
                    <div class="col-md-3">
                        <div class="card mb-4">
                            <div id="" class="card-header">
                                {{ $town->town }}
                            </div>
                            <div class="card-body">
                                <a href="{{route('venues.addressLabels', [$town->town])}}">
                                    <h4 class="card-title"> <i class="far fa-address_1-card"></i>Generate Address Labels</h4>
                                    <a href="{{Storage::url('labels/'. $town->town .'/addresses.pdf')}}">View Labels</a>
                                </a>
                                <a href="{{route('venues.qrcodeLabels', [$town->town])}}">
                                    <h4 class="card-title"> <i class="far fa-address_1-card"></i>Generate QR Code Labels</h4>
                                    <a href="{{Storage::url('labels/'. $town->town .'/qrcodes.pdf')}}">View QR-Codes</a>
                                </a>
                                <a href="{{route('venues.pdf', [$town->town])}}">
                                    <h4 class="card-title"> <i class="fas fa-envelope-open-text"></i> Letters </h4>
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
