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
          <h3>Category: {{$post->category()->first()->name}}</h3>
          <h4>Author: {{$post->user()->first()->name}}</h3>
          <p><b>Content: </b>{{$post->content}}</p>
          <b>Created: {{$post->created_at}}</b>
          <hr>
          <a class='nav-link' href="{{route('admin.posts.edit',$post->slug)}}">Edit this post</a>
        </div>
      </div>
    </div>
@endsection