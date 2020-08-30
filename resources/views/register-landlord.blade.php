@extends('layouts.app')

@section('content')
<div class="colorbar"></div>
<img src="{{asset('/cover/seaside_header.jpg')}}" style="width: 100%;" alt="Seaside sussex">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>Landlord Register</h1></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('company.register') }}">
                            @csrf
                            <input type="hidden" value="company" name="user_type">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>

                                <div class="col-md-6">
                                    <input id="cname" type="text" class="form-control @error('cname') is-invalid @enderror" name="cname" value="{{ old('cname') }}" required autocomplete="cname" autofocus>

                                    @error('cname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="venuetown">Search by town</label>
                                        <input type="text" name="venuetown" id="venuetown" placeholder="Start typing town" class="form-control">
                                        <div id="venueTownList"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="venuenamesearch">Search Venue Name</label>
                                        <input type="text" name="venuenamesearch" id="venuenamesearch" placeholder="Start typing venue name" class="form-control">
                                        <div id="venueList"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="colorbar mt-5"></div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

            $('#venuetown').keyup(function() {
                var query = $(this).val();
                if(query != ''){
                    // var _token = $('meta[name="csrf-token"]').attr('content');
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('search.venuetowns')}}",
                        method: "POST",
                        data: { query: query, _token:_token},
                        success:function(data){
                            $('#venueTownList').fadeIn();
                            $('#venueTownList').html(data);
                        }
                    })
                }
            });

            $('#venuenamesearch').keyup(function() {
                var query = $(this).val();
                if(query != ''){
                    // var _token = $('meta[name="csrf-token"]').attr('content');
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('search.venues')}}",
                        method: "POST",
                        data: { query: query, _token:_token},
                        success:function(data){
                            $('#venueList').fadeIn();
                            $('#venueList').html(data);
                        }
                    });
                    var venueval = $("input:radio[name=selectedVenueID]:checked").val();
                    $("input:text[name=venue_id]").val(venueval);

                }
            });
            function saveevent() {
                var venueval = $("input:radio[name=selectedVenueID]:checked").val();

                $("#venue_id").val(venueval);
            }
            $( "#saveevent" ).on( "click", saveevent );

            $('.timepicker').timepicker({
                timeFormat: 'H:mm p',
                interval: 15,
                minTime: '00',
                maxTime: '23:45',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
            $(function() {
                $( "#eventDate" ).datepicker({
                    dateFormat: "yy-mm-dd"
                });
            });
        });
    </script>
@endsection
