@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$property->propname}}</div>

                    <div class="card-body">
                        <h3>Description</h3>
                        <p>{{$property->description}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Short Info</div>

                    <div class="card-body">
                        <ul class="icons">
                        @if ($property->bedroom > 0)
                                <li>
                                    <i class="fas fa-bed" aria-hidden="true"></i>
                                    <span>{{$property->bedroom}}</span>
                                </li>
                        @endif
                        @if ($property->bathroom > 0)
                            <li>
                                <i class="fas fa-bath" aria-hidden="true"></i>
                                <span>{{$property->bathroom}}</span>
                            </li>
                        @endif
                        @if ($property->reception > 0)
                            <li>
                                <i class="fas fa-couch" aria-hidden="true"></i>
                                <span>{{$property->reception}}</span>
                            </li>
                        @endif
                        @if ($property->kitchen > 0)
                            <li>
                                <i class="fas fa-utensils" aria-hidden="true"></i>
                                <span>{{$property->kitchen}}</span>
                            </li>
                        @endif
                        @if ($property->garage > 0)
                            <li>
                                <i class="fas fa-warehouse" aria-hidden="true"></i>
                                <span>{{$property->garage}}</span>
                            </li>
                        @endif
{{--                        <li>
                                <i class="fas fa-conservatory" aria-hidden="true"></i>
                                {{$property->conservatory}}
                            </li>--}}
                        @if ($property->outbuilding > 0)
                            <li>
                                <i class="fas fa-home" aria-hidden="true"></i>
                                <span>{{$property->outbuilding}}</span>
                            </li>
                        @endif
                        </ul>
                        <p>Created at: {{$property->created_at->diffForHumans()}}</p>
                        <p>Company: <a href="{{route('company.index', [$property->company->id,$property->company->slug])}}">
                                {{$property->company->cname}}
                            </a>
                        </p>
                        <p>Address: {{$property->company->address}}</p>
                    </div>
                </div>
                <br />
                @if(Auth::check()&&Auth::user()->user_type=='seeker')
                <button class="btn btn-success" style="width: 100%;">Enquire</button>
                    @endif

            </div>
        </div>
    </div>
@endsection
