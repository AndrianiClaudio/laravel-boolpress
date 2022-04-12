@extends('layouts.app')


@section('header')
    <div class="container-fluid bg-primary w-100 d-flex justify-content-between">
        <ul class="navbar navbar-nav-inline mb-0 justify-content-center navbar-light shadow-sm">
            <li class="list-inline-item p-2">
                <a href="http://127.0.0.1:8000/login" class="nav-item text-light text-decoration-none text-uppercase">
                    Accedi
                </a>
            </li>
            <li class="list-inline-item p-2">
                <a href="http://127.0.0.1:8000/register" class="nav-item text-light text-decoration-none text-uppercase">
                    Registrati
                </a>
            </li>
        </ul>
        <ul class="navbar navbar-nav-inline mb-0 justify-content-center navbar-light shadow-sm">
            <li class="list-inline-item p-2">
                <a href="/" aria-current="page"
                    class="nav-item text-light text-decoration-none text-uppercase router-link-exact-active router-link-active">
                    Home
                </a>
            </li>
            <li class="list-inline-item p-2">
                <a href="/posts" class="nav-item text-light text-decoration-none text-uppercase">
                    Post
                </a>
            </li>
            <li class="list-inline-item p-2">
                <a href="/about" class="nav-item text-light text-decoration-none text-uppercase">
                    Chi Siamo
                </a>
            </li>
            <li class="list-inline-item p-2">
                <a href="/contacts" class="nav-item text-light text-decoration-none text-uppercase">
                    Contatti
                </a>
            </li>
        </ul>
    </div>

    @php
    /*
            <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
                <div class="container">
                    <a class="navbar-brand text-light" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler border-light" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon border-light"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                        {{-- <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul> --}}

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                            <li class="nav-item">
                                                <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                            @if (Route::has('register'))
        <li class="nav-item">
                                                    <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                                                </li>
        @endif
    @else
        <li class="nav-item dropdown">
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="submit" value="Logout" class="btn btn-default text-light">
                                                </form>
                                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            */
    @endphp
@endsection
@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Accedi') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Accedi') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
