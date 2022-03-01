@extends('layouts.admin')

@section('content')
    <div class="container">
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