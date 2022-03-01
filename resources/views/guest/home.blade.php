@extends('layouts.app')

@section('content')
    <div class="container">
      @guest
        {{-- Ti trovi in views/ 'guest/home.blade.php' --}}
        <b class="text-alert">Effettua il login o registrati</b>
      @endguest
    </div>
@endsection