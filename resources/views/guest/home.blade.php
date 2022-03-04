@php
    $path = Auth::check() ? 'admin' : 'app';
@endphp

@extends('layouts/' . $path)


@section('content')
    <div class="container">
      @guest
        <h1 class="text-alert">Effettua il login o registrati!!</h1>
        @else
      @endguest
    </div>
@endsection