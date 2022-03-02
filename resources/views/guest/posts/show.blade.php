@extends('layouts.app')

@section('content')
    <div class="container-fluid">
      @if (session('status'))
      <div class="col">
        <div class="row">
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
        </div>
      </div>
      @endif
      <div class="row">
        @if(Auth::Check())
          @include('partials.main.leftBar')
        @endif
        <div class="col">
          <div class="card">
            <div class="card-title ml-4">
              <h2>{{$post->title}}</h2>
            </div>
            <div class="card-body">
              <h3>Category: {{$post->category()->first()->name}}</h3>
              <h4>Author: {{$post->user()->first()->name}}</h3>
              <p><b>Content: </b>{{$post->content}}</p>
              <b>Created: {{$post->created_at}}</b>
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection