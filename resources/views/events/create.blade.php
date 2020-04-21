@extends('layouts.app1')

@section('content')
    @if(Auth::user()->user_type != 'admin')
    <div class="container-fluid" style="border-top:6px solid {{Auth::user()->company->primary_color}}"></div>
    @endif
    <div class="container mt-4">
        @if(Auth::user()->user_type == 'admin')
            <a href="/admin/event">Edit Event List</a>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Event Create</h2></div>
                    <div class="card-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @endif
                            <form action="{{route('adminevent.store')}}" method="post" enctype="multipart/form-data">@csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="eventPhoto">Event Photo</label>
                                        <input type="file" class="form-control @error('eventPhoto') is-invalid @enderror" name="eventPhoto">
                                        <br />
                                        @if($errors->has('eventPhoto'))
                                            <div class="error text-danger">{{$errors->first('eventPhoto')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="propname">Event Name</label>
                                            <input type="text" name="eventName" class="form-control @error('eventName') is-invalid @enderror">
                                            @error('eventName')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="eventtype">Event Type</label>
                                            <input type="text" name="eventType" class="form-control @error('eventType') is-invalid @enderror">
                                            @error('eventType')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="eventCost">Event Cost</label>
                                            <input type="text" name="eventCost" class="form-control @error('eventCost') is-invalid @enderror">
                                            @error('eventCost')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="eventDate">Event Date</label>
                                            <input type="text" name="eventDate" id="eventDate" class="form-control @error('eventDate') is-invalid @enderror">
                                            @error('eventDate')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="eventStartTime">Start Time</label>
                                            <input type="text" name="eventTimeStart" class="timepicker form-control @error('eventTimeStart') is-invalid @enderror">
                                            @error('eventTimeStart')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="eventTimeEnd">End Time</label>
                                            <input type="text" name="eventTimeEnd" class="timepicker form-control @error('eventTimeEnd') is-invalid @enderror">
                                            @error('eventTimeEnd')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="hidden" name="venue_id" id="venue_id" value="">
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button type="submit" id="saveevent" class="btn btn-block btn-primary">Save Event</button>
{{--                                            <button type="button"  class="btn btn-block btn-primary">check</button>--}}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @if(Auth::user()->user_type != 'admin')
    <div class="container-fluid mt-4" style="border-top:6px solid {{Auth::user()->company->primary_color}}"></div>
    @endif
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
@endsection