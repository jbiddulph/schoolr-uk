@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                @if(Auth::user()->user_type != 'admin')
                <form action="{{route('property.photo')}}" id="myForm" method="POST" enctype="multipart/form-data">@csrf
                @else
                <form action="{{route('adminproperty.photo')}}" id="myForm2" method="POST" enctype="multipart/form-data">@csrf
                @endif
                    <div class="card">
                        <div class="card-header">
                            Add Photos for Property {{$property->propname}}
                        </div>
                        <input type="hidden" value="{{$propertyId}}" name="property_id">

                        <div class="card-body">
                            <div class="photo_title">
                                <p>Photo Title</p>
                                <p><input type="text" name="photo_title" class="form-control"></p>
                            </div>
                            <div class="photo">
                                <p>Choose your image to upload</p>
                                <p><input type="file" class="form-control" name="property_photo"></p></div>
                            <br />
                            <button class="btn btn-success float-right" type="submit">Upload Photo</button>
                        </div>
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @endif
                    </div>
                </form>
                <br />
                <div class="progress">
                    <div class="progress-bar" role="progressbar"
                    aria-valuenow=""
                    aria-valuemin="0" aria-valuemax="100" style="width:0%;">0%</div>
                </div>
                <div id="success">

                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Property Photos</div>
                    <div class="card-body">
                        @foreach($photos as $propshots)
                            <img src="{{Storage::url($propshots->photo)}}" width="100" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://malsup.github.com/jquery.form.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#myForm').ajaxForm({
           beforeSend:function(){
             $('#success').empty();
           },
            uploadProgress:function(event, position, total, percentComplete)
            {
                $('.progress-bar').text(percentComplete + '%');
                $('.progress-bar').css('width', percentComplete + '%');
            },
            error: function(jqhxr, textStatus, errorText) {
                console.error('There was an error submitting the form!', errorText);
                $('.progress-bar').text('0%');
                $('.progress-bar').css('width', '0%');
                $('#success').html('<span class="text-danger"><b>'+errorText+'</b></span>');
            },
            success: function(response, textStatus, jqxhr, formData)
            {
                console.log('server response', response);
                console.log('text status', textStatus);
                console.log('serialized form data', formData);

                    $('.progress-bar').text('Uploaded');
                    $('.progress-bar').css('width', '100%');
                    $('#success').html('<span class="text-success"><b>'+textStatus+'</b></span>');
                location.reload();
                return false;
            }
        });
    });
</script>


@endsection
