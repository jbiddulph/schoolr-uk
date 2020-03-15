@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="border-top:6px solid {{Auth::user()->company->primary_color}}"></div>
    <img src="{{asset('/cover/jump_header.jpg')}}" style="width: 100%;" alt="Jump header">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                @if(count($applicants) > 0)
                    @foreach($applicants as $applicant)
                    <div class="card mb-4">
                        <div class="card-header"><a href="{{route('properties.show',[$applicant->id, $applicant->slug])}}"><h3>{{$applicant->propname}}</h3></a></div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Type</th>
                                    <th>Identification</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($applicant->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->profile->address}}</td>
                                    <td>{{$user->profile->phone_number}}</td>
                                    <td>{{$user->user_type}}</td>
                                    @if(!empty($user->profile->identification))
                                    <td>
                                        <a href="{{Storage::url($user->profile->identification)}}">Download ID</a>
                                    </td>
                                    @else
                                    <td>N/A</td>
                                    @endif
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                @elseif(count($applicants) == 0)
                    <div class="col-md-6 offset-md-3">
                        <h2 class="text-center">There hasn't been any interest</h2>
                        <p class="text-center">Please check back later.</p>
                        <div class="row mb-4 justify-content-center">
                            <a href="{{route('property.create')}}">
                                <button class="btn btn-secondary">Add a property</button>
                            </a>
                        </div>
                        <div class="row justify-content-center">
                            <a href="{{route('property.myproperty')}}">
                                <button class="btn btn-secondary">My Properties</button>
                            </a>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
    <div class="colorbar mt-5"></div>
@endsection
