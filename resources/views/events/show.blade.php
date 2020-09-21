@extends('layouts.app1')

@section('content')
    <div class="colorbar"></div>
    <div style="height: 300px;" class="header-img">
        @if(isset($event->eventPhoto))
            @php
                $eventphoto = str_replace('public/', 'storage/', $event->eventPhoto)
            @endphp
            <div class="mainpic" style="background-image: url(/{{ $eventphoto }})">
                {{--                <img class="d-block img-fluid prop_photo" src="/{{ $mainphoto }}" alt="{{$thevenue->venuename}}">--}}
            </div>
        @endif
        <div class="qr-code" style="text-align:center; padding-bottom: 10px;">
            <h3>Customer Tag-in</h3>
            <img src="{{url('qrcodes/'. $thevenue->town .'/customers/tagin-'.$thevenue->id.'.png')}}" width="180" />
        </div>
    </div>
    <div class="container mt-4">

        <h1>Event @if(Auth::user()->user_type == 'admin')| <a href="/admin">Admin</a>
                | <a href="/admin/event">Edit Event List</a>
            @endif</h1>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    @if(isset($thevenue->photo))
                        @php
                            $mainphoto = str_replace('public/', 'storage/', $thevenue->photo)
                        @endphp

                        <img class="card-img-top" src="/{{ $mainphoto }}" alt="Card image cap">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{$thevenue->venuename}}</h5>
                        <p class="card-text">{{$thevenue->address}}<br />
                            {{$thevenue->address2}}<br />
                            {{$thevenue->town}}<br />
                            {{$thevenue->county}}<br />
                            {{$thevenue->postcode}}<br /><br />
                            {{$thevenue->telephone}}<br /></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Event: {{$event->eventName}}</h2></div>
                    <div class="card-body">


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        Event Name
                                            {{ $event->eventName }}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            Event Type
                                            {{ $event->eventType }}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            Event Cost
                                            {{ $event->eventCost }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            Event Date
                                            {{ $event->eventDate }}

                                        <div class="form-group">
                                            Start Time
                                            {{ $event->eventTimeStart }}
                                        <div class="form-group">
                                            End Time
                                            {{ $event->eventTimeEnd }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="hidden" name="venue_id" id="venue_id" value="{{ $event->id }}">
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="colorbar"></div>
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
