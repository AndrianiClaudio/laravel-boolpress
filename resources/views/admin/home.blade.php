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
                    <div class="card-title ml-4 my-2 text-primary">
                        <h1>
                            Welcome {{ Auth::user()->name }}
                        </h1>
                    </div>
                    <div class="card-body">
                        <h3>Your info</h3>
                        <div>
                            Email :  {{ Auth::user()->email }}
                        </div>
                        <hr>
                        <div>
                            Phone Number :  {{ Auth::user()->userInfo()->first()->phone }}
                        </div>
                        <hr>
                        <div>
                            Address :  {{ Auth::user()->userInfo()->first()->address }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection