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
            <div class="card-title ms-4">
              <h2>{{$post->title}}</h2>
            </div>
            <div class="card-body">
              <h3>Category: {{$post->category()->first()->name}}</h3>
              <h4>Author: {{$post->user()->first()->name}}</h3>
              <p><b>Content: </b>{{$post->content}}</p>
              @if(count($post->tag()->get()) > 0)
                <div class="row align-items-center">
                  <div class="col-2">
                    <b>Tags: </b>
                  </div>
                  <div class="col-10">
                    <ul class="list-group list-group-horizontal flex-wrap mx-auto">
                    @foreach ($post->tag()->get() as $tag)
                      <li class="list-group-item border-0">#{{$tag->name}}</li>
                    @endforeach
                    </ul>
                  </div>
                </div>
              @endif
              <b>Created: {{$post->created_at}}</b><br>
              <b>Last update: {{$post->updated_at}}</b>
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection