@extends('layouts.app')

@section('content')
    @if(Auth::user()->user_type != 'admin')
        <div class="container-fluid" style="border-top:6px solid {{Auth::user()->company->primary_color}}"></div>
    @endif
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Property Create</h2></div>
                    @if(!auth()->user()->subscribed('main'))

                    @else

                    @endif

                    <div class="card-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @endif
                        @if(Auth::user()->user_type != 'admin')
                            <form action="{{route('property.store')}}" method="post" enctype="multipart/form-data">@csrf
                        @else
                            <form action="{{route('adminproperty.store')}}" method="post" enctype="multipart/form-data">@csrf
                        @endif
                        @if(Auth::user()->user_type == 'admin')
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="proptype">User</label>
                                    <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" id="user_id">
                                        <option value="">Please select</option>
                                        @foreach(App\User::all()->where('user_type', '=', 'company') as $user)
                                            <option value="{{$user->id}}">{{$user->name}}, {{$user->user_type}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="propname">Property Name</label>
                                    <input type="text" name="propname" class="form-control @error('propname') is-invalid @enderror" value="{{ old('propname') }}">
                                    @error('propname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="proptype">Property Type</label>
                                    <select name="proptype_id" class="form-control @error('proptype_id') is-invalid @enderror" id="proptype_id">
                                        <option value="">Please select</option>
                                        @foreach(App\PropertyType::all() as $propType)
                                            <option value="{{$propType->id}}">{{$propType->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('proptype_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="propcost">Cost</label>
                                    <input type="text" name="propcost" class="form-control @error('propcost') is-invalid @enderror" value="{{ old('propcost') }}">
                                    @error('propcost')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bedroom">Bedrooms</label>
                                    <select name="bedroom" class="form-control" id="bedroom">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bathroom">Bathroom</label>
                                    <select name="bathroom" class="form-control" id="bathroom">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kitchen">Kitchen</label>
                                    <select name="kitchen" class="form-control" id="kitchen">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="garage">Garage</label>
                                    <select name="garage" class="form-control" id="garage">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="reception">Reception</label>
                                    <select name="reception" class="form-control" id="reception">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="conservatory">Conservatory</label>
                                    <select name="conservatory" class="form-control" id="conservatory">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="outbuilding">Out Building</label>
                                    <select name="outbuilding" class="form-control" id="outbuilding">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="town">Town</label>
                                    <select name="town" class="form-control @error('user_id') is-invalid @enderror" id="town">
                                        <option value="">Please select</option>
                                        @foreach(App\Property::select('town')->distinct()->get() as $town)
                                            <option value="{{$town->town}}">{{$town->town}}</option>
                                        @endforeach
                                            <option value="other">Other</option>
                                    </select>
                                    <input type="text" name="town" id="other_town" class="form-control @error('town') is-invalid @enderror" value="{{ old('town') }}">
                                    @error('town')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="county">County</label>
                                    <select name="county" class="form-control">
                                        <optgroup label="England">
                                            <option>Please Select</option>
                                            <option value="Bedfordshire">Bedfordshire</option>
                                            <option value="Berkshire">Berkshire</option>
                                            <option value="Bristol">Bristol</option>
                                            <option value="Buckinghamshire">Buckinghamshire</option>
                                            <option value="Cambridgeshire">Cambridgeshire</option>
                                            <option value="Cheshire">Cheshire</option>
                                            <option value="City of London">City of London</option>
                                            <option value="Cornwall">Cornwall</option>
                                            <option value="Cumbria">Cumbria</option>
                                            <option value="Derbyshire">Derbyshire</option>
                                            <option value="Devon">Devon</option>
                                            <option value="Dorset">Dorset</option>
                                            <option value="Durham">Durham</option>
                                            <option value="East Riding of Yorkshire">East Riding of Yorkshire</option>
                                            <option value="East Sussex">East Sussex</option>
                                            <option value="Essex">Essex</option>
                                            <option value="Gloucestershire">Gloucestershire</option>
                                            <option value="Greater London">Greater London</option>
                                            <option value="Greater Manchester">Greater Manchester</option>
                                            <option value="Hampshire">Hampshire</option>
                                            <option value="Herefordshire">Herefordshire</option>
                                            <option value="Hertfordshire">Hertfordshire</option>
                                            <option value="Isle of Wight">Isle of Wight</option>
                                            <option value="Kent">Kent</option>
                                            <option value="Lancashire">Lancashire</option>
                                            <option value="Leicestershire">Leicestershire</option>
                                            <option value="Lincolnshire">Lincolnshire</option>
                                            <option value="Merseyside">Merseyside</option>
                                            <option value="Norfolk">Norfolk</option>
                                            <option value="North Yorkshire">North Yorkshire</option>
                                            <option value="Northamptonshire">Northamptonshire</option>
                                            <option value="Northumberland">Northumberland</option>
                                            <option value="Nottinghamshire">Nottinghamshire</option>
                                            <option value="Oxfordshire">Oxfordshire</option>
                                            <option value="Rutland">Rutland</option>
                                            <option value="Shropshire">Shropshire</option>
                                            <option value="Somerset">Somerset</option>
                                            <option value="South Yorkshire">South Yorkshire</option>
                                            <option value="Staffordshire">Staffordshire</option>
                                            <option value="Suffolk">Suffolk</option>
                                            <option value="Surrey">Surrey</option>
                                            <option value="Tyne and Wear">Tyne and Wear</option>
                                            <option value="Warwickshire">Warwickshire</option>
                                            <option value="West Midlands">West Midlands</option>
                                            <option value="West Sussex">West Sussex</option>
                                            <option value="West Yorkshire">West Yorkshire</option>
                                            <option value="Wiltshire">Wiltshire</option>
                                            <option value="Worcestershire">Worcestershire</option>
                                        </optgroup>
                                        <optgroup label="Wales">
                                            <option value="Anglesey">Anglesey</option>
                                            <option value="Brecknockshire">Brecknockshire</option>
                                            <option value="Caernarfonshire">Caernarfonshire</option>
                                            <option value="Carmarthenshire">Carmarthenshire</option>
                                            <option value="Cardiganshire">Cardiganshire</option>
                                            <option value="Denbighshire">Denbighshire</option>
                                            <option value="Flintshire">Flintshire</option>
                                            <option value="Glamorgan">Glamorgan</option>
                                            <option value="Merioneth">Merioneth</option>
                                            <option value="Monmouthshire">Monmouthshire</option>
                                            <option value="Montgomeryshire">Montgomeryshire</option>
                                            <option value="Pembrokeshire">Pembrokeshire</option>
                                            <option value="Radnorshire">Radnorshire</option>
                                        </optgroup>
                                        <optgroup label="Scotland">
                                            <option value="Aberdeenshire">Aberdeenshire</option>
                                            <option value="Angus">Angus</option>
                                            <option value="Argyllshire">Argyllshire</option>
                                            <option value="Ayrshire">Ayrshire</option>
                                            <option value="Banffshire">Banffshire</option>
                                            <option value="Berwickshire">Berwickshire</option>
                                            <option value="Buteshire">Buteshire</option>
                                            <option value="Cromartyshire">Cromartyshire</option>
                                            <option value="Caithness">Caithness</option>
                                            <option value="Clackmannanshire">Clackmannanshire</option>
                                            <option value="Dumfriesshire">Dumfriesshire</option>
                                            <option value="Dunbartonshire">Dunbartonshire</option>
                                            <option value="East Lothian">East Lothian</option>
                                            <option value="Fife">Fife</option>
                                            <option value="Inverness-shire">Inverness-shire</option>
                                            <option value="Kincardineshire">Kincardineshire</option>
                                            <option value="Kinross">Kinross</option>
                                            <option value="Kirkcudbrightshire">Kirkcudbrightshire</option>
                                            <option value="Lanarkshire">Lanarkshire</option>
                                            <option value="Midlothian">Midlothian</option>
                                            <option value="Morayshire">Morayshire</option>
                                            <option value="Nairnshire">Nairnshire</option>
                                            <option value="Orkney">Orkney</option>
                                            <option value="Peeblesshire">Peeblesshire</option>
                                            <option value="Perthshire">Perthshire</option>
                                            <option value="Renfrewshire">Renfrewshire</option>
                                            <option value="Ross-shire">Ross-shire</option>
                                            <option value="Roxburghshire">Roxburghshire</option>
                                            <option value="Selkirkshire">Selkirkshire</option>
                                            <option value="Shetland">Shetland</option>
                                            <option value="Stirlingshire">Stirlingshire</option>
                                            <option value="Sutherland">Sutherland</option>
                                            <option value="West Lothian">West Lothian</option>
                                            <option value="Wigtownshire">Wigtownshire</option>
                                        </optgroup>
                                        <optgroup label="Northern Ireland">
                                            <option value="Antrim">Antrim</option>
                                            <option value="Armagh">Armagh</option>
                                            <option value="Down">Down</option>
                                            <option value="Fermanagh">Fermanagh</option>
                                            <option value="Londonderry">Londonderry</option>
                                            <option value="Tyrone">Tyrone</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="postcode">Postcode</label>
                                    <input type="text" name="postcode" class="form-control @error('postcode') is-invalid @enderror" value="{{ old('postcode') }}">
                                    @error('postcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude') }}">
                                    @error('latitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude') }}">
                                    @error('longitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="summary-ckeditor">Short Summary</label>
                                    <input name="short_summary" type="text" class="form-control @error('short_summary') is-invalid @enderror" value="{{ old('short_summary') }}">
                                    @error('short_summary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="summary-ckeditor">Summary</label>
                                    <textarea name="summary" class="form-control" id="summary-ckeditor" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="summary-ckeditor">Description</label>
                                    <textarea name="description" class="form-control" id="summary-ckeditor2" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="propimage">Property Photo</label>
                                    <input type="file" name="propimage" class="form-control @error('propimage') is-invalid @enderror" value="{{ old('propimage') }}">
                                    @error('propimage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="floorplan">Floorplan</label>
                                    <input type="file" name="floorplan" class="form-control @error('floorplan') is-invalid @enderror" value="{{ old('floorplan') }}">
                                    @error('floorplan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="brochure">Brochure</label>
                                    <input type="file" name="brochure" class="form-control @error('brochure') is-invalid @enderror" value="{{ old('brochure') }}">
                                    @error('brochure')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_date">Last Date</label>
                                    <input type="text" placeholder="YYYY-MM-DD" name="last_date" id="datepicker" class="date form-control @error('last_date') is-invalid @enderror" value="{{ old('last_date') }}">
                                    @error('last_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" class="form-control" id="category_id">
                                        <option value="">Please select</option>
                                        @foreach(App\Category::all() as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="is_featured">Featured</label>
                                    <select name="is_featured" class="form-control" id="is_featured">
                                        <option value="0">Not Featured</option>
                                        <option value="1">Featured Property</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="is_live">Live</label>
                                    <select name="is_live" class="form-control" id="is_live">
                                        <option value="0">Draft</option>
                                        <option value="1">Live</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="submit" value="Add Property" class="btn btn-dark">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->user_type != 'admin')
        <div class="container-fluid" style="border-bottom:6px solid {{Auth::user()->company->primary_color}}"></div>
    @endif
    @section('script')
        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        <script>
            CKEDITOR.replace( 'summary-ckeditor' );
            CKEDITOR.replace( 'summary-ckeditor2' );
        </script>
        <script type="text/javascript">
            $( document ).ready(function() {
                $('#other_town').css('display','none');
                $("select#town").change(function(){
                    var selectedTown = $(this).children("option:selected").val();
                    if(selectedTown == 'other') {
                        $('#town').css('display','none');
                        $('#other_town').css('display','block');
                    }
                });
            });
        </script>
    @endsection
@endsection

