@extends('layouts.admin')

@section('content')
    <div class="container">
      @if (session('status'))
      <div class="col">
        <div class="row">
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
        </div>
      </div>
      @endif
      <div class="card">
        <div class="card-title ml-4">
          <h2>{{$post->title}}</h2>
        </div>
        <div class="card-body">
          <p><b>Content: </b>{{$post->content}}</p>
          <b>Data creazione: {{$post->created_at}}</b>
        </div>
      </div>
    </div>
@endsection