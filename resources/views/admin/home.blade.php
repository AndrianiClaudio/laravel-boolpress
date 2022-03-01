@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-title">
                        <h1>
                            Welcome {{ Auth::user()->name }}
                        </h1>
                    </div>
                    <div class="card-body">
                        <span>
                            Email :  {{ Auth::user()->email }}
                        </span>
                        <hr>
                        <span>
                            Phone Number :  {{ Auth::user()->userInfo()->first()->phone }}
                        </span>
                        <hr>
                        <span>
                            Address :  {{ Auth::user()->userInfo()->first()->address }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection