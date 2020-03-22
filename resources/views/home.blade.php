@extends('layouts.app')

@section('content')
<div class="colorbar"></div>
<img src="{{asset('/cover/seaside_header.jpg')}}" style="width: 100%;" alt="Seaside sussex">
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Auth::user()->user_type == "admin")
                        You are logged into Administration!
                    @endif
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
<div class="colorbar mt-5"></div>
@endsection
