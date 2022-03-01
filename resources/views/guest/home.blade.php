@php
    $path = Auth::check() ? 'admin' : 'app';
@endphp

@extends('layouts/' . $path)


@section('content')
    <div class="container">
      @guest
        {{-- Ti trovi in views/ 'guest/home.blade.php' --}}
        <b class="text-alert">Effettua il login o registrati</b>
        @else
      @endguest
    </div>
@endsection