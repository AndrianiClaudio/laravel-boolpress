@php
    $path = Auth::check() ? 'admin' : 'app';
@endphp

@extends('layouts/' . $path)

@section('content')
<div class="container-fluid">
  <h1 class="w-100 text-center">All Boolpress Posts</h1>
    {{-- STAMPA DATI POST --}}
    <div class="cards">
      @foreach ($posts as $post)
      <div class="card w-75 mx-auto text-center mb-3">
        <div class="card-body">
          <h4 class="card-title">{{$post->title}}</h4>
          <h5 class="card-subtitle mb-2 text-muted"><b>Author: </b>{{$post->user()->first()->name}}</h5>
          <p class="card-text">{{$post->content}}</p>
          @if(count($post->tag()->get()) > 0)
          {{-- <p class="card-text"> --}}
            <div class="row align-items-center">
              <div class="col-2">
                <b>Tags: </b>
              </div>
              <div class="col-10">
                <ul class="list-group list-group-horizontal mx-auto">
                @foreach ($post->tag()->get() as $tag)
                  <li class="list-group-item border-0">#{{$tag->name}}</li>
                @endforeach
                </ul>
              </div>
            </div>

          {{-- </p> --}}
          @endif
          <h6 class="card-text text-info"><b>Category: </b>{{$post->category()->first()->name}}</h6>
          <div class="row justify-content-center ">
            {{-- VIEW POST --}}
            <a class="btn btn-primary" 
            href="
            @guest {{ route('guest.posts.show', $post->slug) }}
            @else  {{ route('admin.posts.show', $post->slug) }} @endguest
            ">
              View
            </a>
            @if(Auth::check() && Auth::user()->id === $post->user_id)
              {{-- EDIT POST --}}
              <a class="btn btn-info ms-2" href="{{ route('admin.posts.edit', $post->slug) }}">Modify</a>
              {{-- DELETE POST --}}
              <form class="ms-2" action="{{ route('admin.posts.destroy', $post->slug) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <input class="btn btn-danger" type="submit" value="Delete">
              </form>
            @endif
          </div>
        </div>
      </div>
      @endforeach
      <div class="col-3 mx-auto mb-3">
        {{$posts->links()}}
      </div>
    </div>
</div>
@endsection
