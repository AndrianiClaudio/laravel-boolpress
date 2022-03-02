<header class='header'>
  {{-- header -> header.blade.php --}}
   <nav class="navbar w-100 navbar-expand-md @guest navbar-light bg-light @else navbar-dark bg-primary @endguest shadow-sm">
      <div class="container">
          {{-- LOGO --}}
          <a class="navbar-brand" href="{{route('guest.home')}}">
            {{config('app.name')}}
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    {{-- REGISTER --}}
                    @if (Route::has('register'))
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                          </li>
                      @endif
                  @else
                    <li class="nav-item dropdown">
                        {{-- AUTH NAME --}}
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            {{-- LOGOUT --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            {{-- LOGOUT FORM --}}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                  @endguest
              </ul>
          </div>
      </div>
  </nav>
</header>