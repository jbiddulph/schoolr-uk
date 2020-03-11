@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Property Create</h2></div>
                    <div class="card-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{Session::get('message')}}
                            </div>
                        @endif
                        <form action="{{route('property.update', [$property->id])}}" method="post" enctype="multipart/form-data">@csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="propname">Property Name</label>
                                        <input type="text" name="propname" class="form-control @error('propname') is-invalid @enderror" value="{{ $property->propname }}">
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
                                        <input type="text" name="proptype" class="form-control @error('proptype') is-invalid @enderror" value="{{ $property->proptype }}">
                                        @error('proptype')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="propcost">Property Cost</label>
                                        <input type="text" name="propcost" class="form-control @error('propcost') is-invalid @enderror" value="{{ $property->propcost }}">
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
                                            <option value="0"{{$property->bedroom==0?'selected':''}}>0</option>
                                            <option value="1"{{$property->bedroom==1?'selected':''}}>1</option>
                                            <option value="2"{{$property->bedroom==2?'selected':''}}>2</option>
                                            <option value="3"{{$property->bedroom==3?'selected':''}}>3</option>
                                            <option value="4"{{$property->bedroom==4?'selected':''}}>4</option>
                                            <option value="5"{{$property->bedroom==5?'selected':''}}>5</option>
                                            <option value="6"{{$property->bedroom==6?'selected':''}}>6</option>
                                            <option value="7"{{$property->bedroom==7?'selected':''}}>7</option>
                                            <option value="8"{{$property->bedroom==8?'selected':''}}>8</option>
                                            <option value="9"{{$property->bedroom==9?'selected':''}}>9</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bathroom">Bathroom</label>
                                        <select name="bathroom" class="form-control" id="bathroom">
                                            <option value="0"{{$property->bathroom==0?'selected':''}}>0</option>
                                            <option value="1"{{$property->bathroom==1?'selected':''}}>1</option>
                                            <option value="2"{{$property->bathroom==2?'selected':''}}>2</option>
                                            <option value="3"{{$property->bathroom==3?'selected':''}}>3</option>
                                            <option value="4"{{$property->bathroom==4?'selected':''}}>4</option>
                                            <option value="5"{{$property->bathroom==5?'selected':''}}>5</option>
                                            <option value="6"{{$property->bathroom==6?'selected':''}}>6</option>
                                            <option value="7"{{$property->bathroom==7?'selected':''}}>7</option>
                                            <option value="8"{{$property->bathroom==8?'selected':''}}>8</option>
                                            <option value="9"{{$property->bathroom==9?'selected':''}}>9</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="kitchen">Kitchen</label>
                                        <select name="kitchen" class="form-control" id="kitchen">
                                            <option value="0"{{$property->kitchen==0?'selected':''}}>0</option>
                                            <option value="1"{{$property->kitchen==1?'selected':''}}>1</option>
                                            <option value="2"{{$property->kitchen==2?'selected':''}}>2</option>
                                            <option value="3"{{$property->kitchen==3?'selected':''}}>3</option>
                                            <option value="4"{{$property->kitchen==4?'selected':''}}>4</option>
                                            <option value="5"{{$property->kitchen==5?'selected':''}}>5</option>
                                            <option value="6"{{$property->kitchen==6?'selected':''}}>6</option>
                                            <option value="7"{{$property->kitchen==7?'selected':''}}>7</option>
                                            <option value="8"{{$property->kitchen==8?'selected':''}}>8</option>
                                            <option value="9"{{$property->kitchen==9?'selected':''}}>9</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="garage">Garage</label>
                                        <select name="garage" class="form-control" id="garage">
                                            <option value="0"{{$property->garage==0?'selected':''}}>0</option>
                                            <option value="1"{{$property->garage==1?'selected':''}}>1</option>
                                            <option value="2"{{$property->garage==2?'selected':''}}>2</option>
                                            <option value="3"{{$property->garage==3?'selected':''}}>3</option>
                                            <option value="4"{{$property->garage==4?'selected':''}}>4</option>
                                            <option value="5"{{$property->garage==5?'selected':''}}>5</option>
                                            <option value="6"{{$property->garage==6?'selected':''}}>6</option>
                                            <option value="7"{{$property->garage==7?'selected':''}}>7</option>
                                            <option value="8"{{$property->garage==8?'selected':''}}>8</option>
                                            <option value="9"{{$property->garage==9?'selected':''}}>9</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="reception">Reception</label>
                                        <select name="reception" class="form-control" id="reception">
                                            <option value="0"{{$property->reception==0?'selected':''}}>0</option>
                                            <option value="1"{{$property->reception==1?'selected':''}}>1</option>
                                            <option value="2"{{$property->reception==2?'selected':''}}>2</option>
                                            <option value="3"{{$property->reception==3?'selected':''}}>3</option>
                                            <option value="4"{{$property->reception==4?'selected':''}}>4</option>
                                            <option value="5"{{$property->reception==5?'selected':''}}>5</option>
                                            <option value="6"{{$property->reception==6?'selected':''}}>6</option>
                                            <option value="7"{{$property->reception==7?'selected':''}}>7</option>
                                            <option value="8"{{$property->reception==8?'selected':''}}>8</option>
                                            <option value="9"{{$property->reception==9?'selected':''}}>9</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="conservatory">Conservatory</label>
                                        <select name="conservatory" class="form-control" id="conservatory">
                                            <option value="0"{{$property->conservatory==0?'selected':''}}>0</option>
                                            <option value="1"{{$property->conservatory==1?'selected':''}}>1</option>
                                            <option value="2"{{$property->conservatory==2?'selected':''}}>2</option>
                                            <option value="3"{{$property->conservatory==3?'selected':''}}>3</option>
                                            <option value="4"{{$property->conservatory==4?'selected':''}}>4</option>
                                            <option value="5"{{$property->conservatory==5?'selected':''}}>5</option>
                                            <option value="6"{{$property->conservatory==6?'selected':''}}>6</option>
                                            <option value="7"{{$property->conservatory==7?'selected':''}}>7</option>
                                            <option value="8"{{$property->conservatory==8?'selected':''}}>8</option>
                                            <option value="9"{{$property->conservatory==9?'selected':''}}>9</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="outbuilding">Out Building</label>
                                        <select name="outbuilding" class="form-control" id="outbuilding">
                                            <option value="0"{{$property->outbuilding==0?'selected':''}}>0</option>
                                            <option value="1"{{$property->outbuilding==1?'selected':''}}>1</option>
                                            <option value="2"{{$property->outbuilding==2?'selected':''}}>2</option>
                                            <option value="3"{{$property->outbuilding==3?'selected':''}}>3</option>
                                            <option value="4"{{$property->outbuilding==4?'selected':''}}>4</option>
                                            <option value="5"{{$property->outbuilding==5?'selected':''}}>5</option>
                                            <option value="6"{{$property->outbuilding==6?'selected':''}}>6</option>
                                            <option value="7"{{$property->outbuilding==7?'selected':''}}>7</option>
                                            <option value="8"{{$property->outbuilding==8?'selected':''}}>8</option>
                                            <option value="9"{{$property->outbuilding==9?'selected':''}}>9</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ $property->address }}">
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
                                        <input type="text" name="town" class="form-control @error('town') is-invalid @enderror" value="{{ $property->town }}">
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
                                                <option value="">Please Select</option>
                                                <option value="Bedfordshire"{{$property->county=='Bedfordshire'?'selected':''}}>Bedfordshire</option>
                                                <option value="Berkshire"{{$property->county=='Berkshire'?'selected':''}}>Berkshire</option>
                                                <option value="Bristol"{{$property->county=='Bristol'?'selected':''}}>Bristol</option>
                                                <option value="Buckinghamshire"{{$property->county=='Buckinghamshire'?'selected':''}}>Buckinghamshire</option>
                                                <option value="Cambridgeshire"{{$property->county=='Cambridgeshire'?'selected':''}}>Cambridgeshire</option>
                                                <option value="Cheshire"{{$property->county=='Cheshire'?'selected':''}}>Cheshire</option>
                                                <option value="City of London"{{$property->county=='City of London'?'selected':''}}>City of London</option>
                                                <option value="Cornwall"{{$property->county=='Cornwall'?'selected':''}}>Cornwall</option>
                                                <option value="Cumbria"{{$property->county=='Cumbria'?'selected':''}}>Cumbria</option>
                                                <option value="Derbyshire"{{$property->county=='Derbyshire'?'selected':''}}>Derbyshire</option>
                                                <option value="Devon"{{$property->county=='Devon'?'selected':''}}>Devon</option>
                                                <option value="Dorset"{{$property->county=='Dorset'?'selected':''}}>Dorset</option>
                                                <option value="Durham"{{$property->county=='Durham'?'selected':''}}>Durham</option>
                                                <option value="East Riding of Yorkshire"{{$property->county=='East Riding of Yorkshire'?'selected':''}}>East Riding of Yorkshire</option>
                                                <option value="East Sussex"{{$property->county=='East Sussex'?'selected':''}}>East Sussex</option>
                                                <option value="Essex"{{$property->county=='Essex'?'selected':''}}>Essex</option>
                                                <option value="Gloucestershire"{{$property->county=='Gloucestershire'?'selected':''}}>Gloucestershire</option>
                                                <option value="Greater London"{{$property->county=='Greater London'?'selected':''}}>Greater London</option>
                                                <option value="Greater Manchester"{{$property->county=='Greater Manchester'?'selected':''}}>Greater Manchester</option>
                                                <option value="Hampshire"{{$property->county=='Hampshire'?'selected':''}}>Hampshire</option>
                                                <option value="Herefordshire"{{$property->county=='Herefordshire'?'selected':''}}>Herefordshire</option>
                                                <option value="Hertfordshire"{{$property->county=='Hertfordshire'?'selected':''}}>Hertfordshire</option>
                                                <option value="Isle of Wight"{{$property->county=='Isle of Wight'?'selected':''}}>Isle of Wight</option>
                                                <option value="Kent"{{$property->county=='Kent'?'selected':''}}>Kent</option>
                                                <option value="Lancashire"{{$property->county=='Lancashire'?'selected':''}}>Lancashire</option>
                                                <option value="Leicestershire"{{$property->county=='Leicestershire'?'selected':''}}>Leicestershire</option>
                                                <option value="Lincolnshire"{{$property->county=='Lincolnshire'?'selected':''}}>Lincolnshire</option>
                                                <option value="Merseyside"{{$property->county=='Merseyside'?'selected':''}}>Merseyside</option>
                                                <option value="Norfolk"{{$property->county=='Norfolk'?'selected':''}}>Norfolk</option>
                                                <option value="North Yorkshire"{{$property->county=='North Yorkshire'?'selected':''}}>North Yorkshire</option>
                                                <option value="Northamptonshire"{{$property->county=='Northamptonshire'?'selected':''}}>Northamptonshire</option>
                                                <option value="Northumberland"{{$property->county=='Northumberland'?'selected':''}}>Northumberland</option>
                                                <option value="Nottinghamshire"{{$property->county=='Nottinghamshire'?'selected':''}}>Nottinghamshire</option>
                                                <option value="Oxfordshire"{{$property->county=='Oxfordshire'?'selected':''}}>Oxfordshire</option>
                                                <option value="Rutland"{{$property->county=='Rutland'?'selected':''}}>Rutland</option>
                                                <option value="Shropshire"{{$property->county=='Shropshire'?'selected':''}}>Shropshire</option>
                                                <option value="Somerset"{{$property->county=='Somerset'?'selected':''}}>Somerset</option>
                                                <option value="South Yorkshire"{{$property->county=='South Yorkshire'?'selected':''}}>South Yorkshire</option>
                                                <option value="Staffordshire"{{$property->county=='Staffordshire'?'selected':''}}>Staffordshire</option>
                                                <option value="Suffolk"{{$property->county=='Suffolk'?'selected':''}}>Suffolk</option>
                                                <option value="Surrey"{{$property->county=='Surrey'?'selected':''}}>Surrey</option>
                                                <option value="Tyne and Wear"{{$property->county=='Tyne and Wear'?'selected':''}}>Tyne and Wear</option>
                                                <option value="Warwickshire"{{$property->county=='Warwickshire'?'selected':''}}>Warwickshire</option>
                                                <option value="West Midlands"{{$property->county=='West Midlands'?'selected':''}}>West Midlands</option>
                                                <option value="West Sussex"{{$property->county=='West Sussex'?'selected':''}}>West Sussex</option>
                                                <option value="West Yorkshire"{{$property->county=='West Yorkshire'?'selected':''}}>West Yorkshire</option>
                                                <option value="Wiltshire"{{$property->county=='Wiltshire'?'selected':''}}>Wiltshire</option>
                                                <option value="Worcestershire"{{$property->county=='Worcestershire'?'selected':''}}>Worcestershire</option>
                                            </optgroup>
                                            <optgroup label="Wales">
                                                <option value="Anglesey"{{$property->county=='Anglesey'?'selected':''}}>Anglesey</option>
                                                <option value="Brecknockshire"{{$property->county=='Brecknockshire'?'selected':''}}>Brecknockshire</option>
                                                <option value="Caernarfonshire"{{$property->county=='Caernarfonshire'?'selected':''}}>Caernarfonshire</option>
                                                <option value="Carmarthenshire"{{$property->county=='Carmarthenshire'?'selected':''}}>Carmarthenshire</option>
                                                <option value="Cardiganshire"{{$property->county=='Cardiganshire'?'selected':''}}>Cardiganshire</option>
                                                <option value="Denbighshire"{{$property->county=='Denbighshire'?'selected':''}}>Denbighshire</option>
                                                <option value="Flintshire"{{$property->county=='Flintshire'?'selected':''}}>Flintshire</option>
                                                <option value="Glamorgan"{{$property->county=='Glamorgan'?'selected':''}}>Glamorgan</option>
                                                <option value="Merioneth"{{$property->county=='Merioneth'?'selected':''}}>Merioneth</option>
                                                <option value="Monmouthshire"{{$property->county=='Monmouthshire'?'selected':''}}>Monmouthshire</option>
                                                <option value="Montgomeryshire"{{$property->county=='Montgomeryshire'?'selected':''}}>Montgomeryshire</option>
                                                <option value="Pembrokeshire"{{$property->county=='Pembrokeshire'?'selected':''}}>Pembrokeshire</option>
                                                <option value="Radnorshire"{{$property->county=='Radnorshire'?'selected':''}}>Radnorshire</option>
                                            </optgroup>
                                            <optgroup label="Scotland">
                                                <option value="Aberdeenshire"{{$property->county=='Aberdeenshire'?'selected':''}}>Aberdeenshire</option>
                                                <option value="Angus"{{$property->county=='Angus'?'selected':''}}>Angus</option>
                                                <option value="Argyllshire"{{$property->county=='Argyllshire'?'selected':''}}>Argyllshire</option>
                                                <option value="Ayrshire"{{$property->county=='Ayrshire'?'selected':''}}>Ayrshire</option>
                                                <option value="Banffshire"{{$property->county=='Banffshire'?'selected':''}}>Banffshire</option>
                                                <option value="Berwickshire"{{$property->county=='Berwickshire'?'selected':''}}>Berwickshire</option>
                                                <option value="Buteshire"{{$property->county=='Buteshire'?'selected':''}}>Buteshire</option>
                                                <option value="Cromartyshire"{{$property->county=='Cromartyshire'?'selected':''}}>Cromartyshire</option>
                                                <option value="Caithness"{{$property->county=='Caithness'?'selected':''}}>Caithness</option>
                                                <option value="Clackmannanshire"{{$property->county=='Clackmannanshire'?'selected':''}}>Clackmannanshire</option>
                                                <option value="Dumfriesshire"{{$property->county=='Dumfriesshire'?'selected':''}}>Dumfriesshire</option>
                                                <option value="Dunbartonshire"{{$property->county=='Dunbartonshire'?'selected':''}}>Dunbartonshire</option>
                                                <option value="East Lothian"{{$property->county=='East Lothian'?'selected':''}}>East Lothian</option>
                                                <option value="Fife"{{$property->county=='Fife'?'selected':''}}>Fife</option>
                                                <option value="Inverness-shire"{{$property->county=='Inverness-shire'?'selected':''}}>Inverness-shire</option>
                                                <option value="Kincardineshire"{{$property->county=='Kincardineshire'?'selected':''}}>Kincardineshire</option>
                                                <option value="Kinross"{{$property->county=='Kinross'?'selected':''}}>Kinross</option>
                                                <option value="Kirkcudbrightshire"{{$property->county=='Kirkcudbrightshire'?'selected':''}}>Kirkcudbrightshire</option>
                                                <option value="Lanarkshire"{{$property->county=='Lanarkshire'?'selected':''}}>Lanarkshire</option>
                                                <option value="Midlothian"{{$property->county=='Midlothian'?'selected':''}}>Midlothian</option>
                                                <option value="Morayshire"{{$property->county=='Morayshire'?'selected':''}}>Morayshire</option>
                                                <option value="Nairnshire"{{$property->county=='Nairnshire'?'selected':''}}>Nairnshire</option>
                                                <option value="Orkney"{{$property->county=='Orkney'?'selected':''}}>Orkney</option>
                                                <option value="Peeblesshire"{{$property->county=='Peeblesshire'?'selected':''}}>Peeblesshire</option>
                                                <option value="Perthshire"{{$property->county=='Perthshire'?'selected':''}}>Perthshire</option>
                                                <option value="Renfrewshire"{{$property->county=='Renfrewshire'?'selected':''}}>Renfrewshire</option>
                                                <option value="Ross-shire"{{$property->county=='Ross-shire'?'selected':''}}>Ross-shire</option>
                                                <option value="Roxburghshire"{{$property->county=='Roxburghshire'?'selected':''}}>Roxburghshire</option>
                                                <option value="Selkirkshire"{{$property->county=='Selkirkshire'?'selected':''}}>Selkirkshire</option>
                                                <option value="Shetland"{{$property->county=='Shetland'?'selected':''}}>Shetland</option>
                                                <option value="Stirlingshire"{{$property->county=='Stirlingshire'?'selected':''}}>Stirlingshire</option>
                                                <option value="Sutherland"{{$property->county=='Sutherland'?'selected':''}}>Sutherland</option>
                                                <option value="West Lothian"{{$property->county=='West Lothian'?'selected':''}}>West Lothian</option>
                                                <option value="Wigtownshire"{{$property->county=='Wigtownshire'?'selected':''}}>Wigtownshire</option>
                                            </optgroup>
                                            <optgroup label="Northern Ireland">
                                                <option value="Antrim"{{$property->county=='Antrim'?'selected':''}}>Antrim</option>
                                                <option value="Armagh"{{$property->county=='Armagh'?'selected':''}}>Armagh</option>
                                                <option value="Down"{{$property->county=='Down'?'selected':''}}>Down</option>
                                                <option value="Fermanagh"{{$property->county=='Fermanagh'?'selected':''}}>Fermanagh</option>
                                                <option value="Londonderry"{{$property->county=='Londonderry'?'selected':''}}>Londonderry</option>
                                                <option value="Tyrone"{{$property->county=='Tyrone'?'selected':''}}>Tyrone</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="postcode">Postcode</label>
                                        <input type="text" name="postcode" class="form-control @error('postcode') is-invalid @enderror" value="{{ $property->postcode }}">
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
                                        <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror" value="{{ $property->latitude }}">
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
                                        <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror" value="{{ $property->longitude }}">
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
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ $property->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_date">Last Date</label>
                                        <input type="text" name="last_date" class="form-control @error('last_date') is-invalid @enderror" value="{{ $property->last_date }}">
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
                                                <option value="{{$cat->id}}"{{$property->category_id==$cat->id?'selected':''}}>{{$cat->name}}</option>
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
                                            <option value="0"{{$property->is_featured=='0'?'selected':''}}>Not Featured</option>
                                            <option value="1"{{$property->is_featured=='1'?'selected':''}}>Featured Property</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_live">Live</label>
                                        <select name="is_live" class="form-control" id="is_live">
                                            <option value="0"{{$property->is_live=='0'?'selected':''}}>Draft</option>
                                            <option value="1"{{$property->is_live=='1'?'selected':''}}>Live</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 offset-8">
                                    <input type="submit" value="Update Property" class="btn btn-dark">
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-4">
                                <form action="{{route('property.image')}}" method="POST" enctype="multipart/form-data">@csrf
                                    <div class="card">
                                        <div class="card-header">Property Image</div>
                                        <div class="card-body">
                                            <input type="file" class="form-control" name="propimage">
                                            <br />
                                            <button class="btn btn-dark float-right" type="submit">Update Property Image</button>
                                            @if($errors->has('propimage'))
                                                <div class="error text-danger">{{$errors->first('propimage')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
{{--                                <form action="{{route('property.propimage')}}" method="POST" enctype="multipart/form-data">@csrf--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="card-header">Property Image</div>--}}
{{--                                        <div class="card-body">--}}
{{--                                            <input type="file" class="form-control" name="propimage">--}}
{{--                                            <br />--}}
{{--                                            <button class="btn btn-dark float-right" type="submit">Update Property Image</button>--}}
{{--                                            @if($errors->has('propimage'))--}}
{{--                                                <div class="error text-danger">{{$errors->first('propimage')}}</div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
                            </div>
                            <div class="col-md-4">
{{--                                <form action="{{route('property.propimage')}}" method="POST" enctype="multipart/form-data">@csrf--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="card-header">Property Image</div>--}}
{{--                                        <div class="card-body">--}}
{{--                                            <input type="file" class="form-control" name="propimage">--}}
{{--                                            <br />--}}
{{--                                            <button class="btn btn-dark float-right" type="submit">Update Property Image</button>--}}
{{--                                            @if($errors->has('propimage'))--}}
{{--                                                <div class="error text-danger">{{$errors->first('propimage')}}</div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
