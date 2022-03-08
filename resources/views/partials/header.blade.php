<nav class="navbar navbar-expand-md shadow-sm
@guest navbar-light bg-light 
@else navbar-dark bg-dark @endguest"
id="navbar-header">
    <div class="container-fluid px-3">
        {{-- LOGO --}}
        <a class="d-block navbar-brand text-success font-weight-bold text-uppercase text-info logo" href="{{route('admin.home')}}">{{config('app.name')}}</a>
        
        @if(Auth::Check())
        <div class="d-flex justify-content-end align-items-center">
            <a href="default">
                {{-- Go to front office page --}}
                All post
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
            @endif
            {{-- LOGIN AND REGISTER --}}
            <nav class="d-flex justify-content-end">
                <ul class="navbar-nav flex-row">
                    @guest
                        {{-- LOGIN --}}
                        <li class="nav-item pe-3">
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
            </nav>
        </div>

    </div>
</nav>