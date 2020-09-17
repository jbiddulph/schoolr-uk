@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Venue Tag-in</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>{{ $thevenue->venuename }}, {{ $thevenue->town }}</h2></div>
                    <div class="card-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @endif
                        <form action="{{route('venue.tagin', [$thevenue->id])}}" method="post" enctype="multipart/form-data">@csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="propname">Phone number</label>
                                        <input type="hidden" name="venue_id" value="{{$thevenue->id}}">
                                        <input type="number" id="phone_number" name="phone_number" class="phone_number form-control @error('phone_number') is-invalid @enderror" autofocus>
                                        @error('venuename')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="venuetype">Email Address</label>
                                        <input type="text" name="email_address" class="form-control @error('email_address') is-invalid @enderror">
                                        @error('venuetype')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Reason for visit</label>
                                        <select name="reason_visit" id="reason_visit" class="form-control @error('reason_visit') is-invalid @enderror">
                                            <option value="">Please select</option>
                                            <option value="meet">Meet someone</option>
                                            <option value="friends">Meet friends</option>
                                            <option value="socialise">Socialise</option>
                                            <option value="eat">To eat</option>
                                            <option value="music">For the music</option>
                                            <option value="sport">To watch sport</option>
                                            <option value="passing">Just passing</option>
                                            <option value="other">Other</option>
                                        </select>

                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>I consent to this venue keeping my details hidden and private and will only be ussed if in an emergency.<br /> Or if someone else at the venue has symptoms of Covid-19:</label>
                                    <input class="mktFormCheckbox" name="consent" id="marketing" type='checkbox' required/>
                                    <span class="mktFormMsg"></span>
                                </div>
                                <div class="col-md-6">
                                    <label>Keep me up to date with future events and promotions at this venue:</label>
                                    <input class="mktFormCheckbox marketing" name="marketing" id="marketing" type='checkbox' value="1" />
                                    <span class="mktFormMsg"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 offset-md-4">
                                    <button type="submit" class="btn bt-lg btn-primary">Tag in!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            window.onload = function () {
                $('#phone_number').click(function() {
                    $('.phone_number').focus();
                });
            };
        });
    </script>
@endsection
