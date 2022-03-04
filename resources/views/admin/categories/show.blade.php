@extends('layouts.admin')

@section('content')
  <div class="container-fluid">
    {{-- MESSAGGIO REDIRECT STATUS --}}
    @if (session('status'))
      <div class="row">
        <div class="col-6 mx-auto">
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        </div>
      </div>
    @endif
    <h2 class="w-100 text-center">All post of Category :{{$category->name}}</h2>
    {{-- FINE MESSAGGIO REDIRECT STATUS --}}
    <div class="cards text-center">
      @if((count($category->posts()->get()) === 0))
        <h4 class="w-75 mx-auto">Non sono presenti post in questa categoria.</h4>
      @else
        @foreach ($category->posts()->get() as $post)
        <div class="card w-75 mx-auto text-center mb-3">
          <div class="card-title ml-4 mt-2">
            <h2><b>Title: </b>{{$post->title}}</h2>
          </div>
          <div class="card-body pt-0">
            <h3>Category: {{$post->category()->first()->name}}</h3>
            <h4>Author: {{$post->user()->first()->name}}</h3>
            <p><b>Content: </b>{{$post->content}}</p>
            <b>Created: {{$post->created_at}}</b><br>
            <b>Last update: {{$post->updated_at}}</b>
            @if(Auth::user()->id === $post->id)
            <hr>
              <div class="row align-items-center justify-content-center text-center">
                <a class='btn btn-info' href="{{route('admin.posts.edit',$post->slug)}}">Edit Post</a>
              
                {{-- Delete this post --}}
                <form action="{{ route('admin.posts.destroy', $post->slug) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <input class="btn btn-danger ml-3" type="submit" value="Delete">
                </form>
              </div>
            @endif
          </div>
        </div>
        @endforeach
      @endif
    </div>
  </div>
@endsection