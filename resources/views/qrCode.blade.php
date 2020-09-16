@extends('layouts.app')

@section('content')
    <div class="colorbar"></div>
    <img src="{{asset('/cover/bar_header.jpg')}}" style="width: 100%;" alt="Bar Header">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="visible-print text-center">
                    <h1>Laravel 5.7 - QR Code Generator Example</h1>

                    {!! QrCode::size(250)->generate('ItSolutionStuff.com'); !!}

                    <p>example by ItSolutionStuf.com.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
