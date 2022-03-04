<nav class="navbar navbar-expand-md shadow-sm
@guest navbar-light bg-light 
@else navbar-dark bg-dark @endguest">
    <div class="container-fluid px-3">
        <div class="d-flex">
            {{-- LOGO --}}
            <a class="d-block navbar-brand text-success font-weight-bold text-uppercase text-info logo" href="{{route('guest.home')}}">
                {{config('app.name')}}
            </a>
            {{-- LOGOUT D-MD-NONE --}}
            <a class="d-md-none nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                title="Logout">
                {{-- {{ __('Logout') }} --}}
                <i class="bi bi-x-circle"></i>
            </a>
            {{-- LOGOUT HIDDEN FORM --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
                
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                {{-- POSTS --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guest.posts.index') }}">All Post</a>
                </li>

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    {{-- LOGIN --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login <i class="bi bi-house"></i></a>
                    </li>
                    {{-- REGISTER --}}
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register <i class="bi bi-person-plus"></i></a>
                        </li>
                    @endif
                @else
                    <li class="nav-item d-none d-md-block">
                        {{-- LOGOUT D-MD-BLOCK--}}
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            title="Logout">
                            {{-- {{ __('Logout') }} --}}
                            <i class="bi bi-x-circle"></i>
                        </a>
                        {{-- LOGOUT HIDDEN FORM --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>