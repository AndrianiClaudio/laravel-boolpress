@extends('layouts.app')
@section('header')
    <div class="container-fluid bg-primary w-100 d-flex justify-content-between">
        <ul class="navbar navbar-nav-inline mb-0 justify-content-center navbar-light shadow-sm">
            <li class="list-inline-item p-2"><a href="http://127.0.0.1:8000/login"
                    class="nav-item text-light text-decoration-none text-uppercase">Accedi</a></li>
            <li class="list-inline-item p-2"><a href="http://127.0.0.1:8000/register"
                    class="nav-item text-light text-decoration-none text-uppercase">Registrati</a></li>
        </ul>
        <ul class="navbar navbar-nav-inline mb-0 justify-content-center navbar-light shadow-sm">
            <li class="list-inline-item p-2"><a href="/" aria-current="page"
                    class="nav-item text-light text-decoration-none text-uppercase router-link-exact-active router-link-active">Home</a>
            </li>
            <li class="list-inline-item p-2"><a href="/posts"
                    class="nav-item text-light text-decoration-none text-uppercase">Post</a></li>
            <li class="list-inline-item p-2"><a href="/about"
                    class="nav-item text-light text-decoration-none text-uppercase">Chi Siamo</a></li>
            <li class="list-inline-item p-2"><a href="/contacts"
                    class="nav-item text-light text-decoration-none text-uppercase">Contatti</a></li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrati') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
