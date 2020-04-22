<nav class="navbar navbar-fixed-top navbar-expand-md navbar-light">
    <a class="navbar-brand primary" href="{{ url('/') }}">
        <img src="{{asset('logo/primary_marker.png')}}" height="40" alt="BN Here logo">
        <strong class="mr-2">Local</strong><span class="small_slogan">news, nightlife, property</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('venues.show') }}">Pubs &amp; Venues</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('allproperties')}}">All Properties</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Register
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('User Register') }}</a>
                        @endif
                        <a class="nav-link" href="{{ route('register.company') }}">{{ __('Company Register') }}</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @else
                @if(Auth::user()->user_type=='company')
                <li>
                    <a href="{{route('property.create')}}">
                        <button class="btn btn-secondary">Add property</button>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('venues.show') }}">Pubs &amp; Venues</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('allproperties')}}">All Properties</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                        @if(Auth::user()->user_type=='company')
                            {{ Auth::user()->name }}
                        @else
                            {{ Auth::user()->name }}
                        @endif<span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if(Auth::user()->user_type=='company')
                            <a href="{{route('company.view')}}" class="dropdown-item">{{__('Company')}}</a>
                            <a href="{{route('property.myproperty')}}" class="dropdown-item">{{__('My Properties')}}</a>
                            <a href="{{route('applicants')}}" class="dropdown-item">{{__('Applicants')}}</a>
                        @else
                            <a href="{{route('user.view')}}" class="dropdown-item">{{__('Profile')}}</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
