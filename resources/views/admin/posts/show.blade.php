@extends('layouts.admin')

@section('content')
    <div class="container">
      {{-- MESSAGGIO REDIRECT STATUS --}}
      @if (session('status'))
      <div class="col">
        <div class="row">
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        </div>
      </div>
      {{-- FINE MESSAGGIO REDIRECT STATUS --}}
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

          {{-- Delete this post --}}
          <form action="{{ route('admin.posts.destroy', $post->slug) }}" method="post">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger ml-3" type="submit" value="Delete">
          </form>
        </div>
      </div>
    </div>
@endsection