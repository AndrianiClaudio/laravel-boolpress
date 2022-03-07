@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="row">
    {{-- MESSAGGIO REDIRECT STATUS --}}
    @if (session('statusError'))
    <div class="col-6 mx-auto">
      <div class="alert alert-danger mx-auto">
        {{ session('statusError') }}
      </div>
    </div>
    {{-- FINE MESSAGGIO REDIRECT STATUS --}}
    @endif
    @if (session('status'))
    <div class="col-6 mx-auto">
      <div class="alert alert-success mx-auto">
        {{ session('status') }}
      </div>
    </div>
    {{-- FINE MESSAGGIO REDIRECT STATUS --}}
    @endif
    <div class="col-12">
      <h1 class="text-center">POSTS</h1>
    </div>
    
    {{-- STAMPA DATI POST --}}
    <div class="cards w-100 mx-auto">
      @foreach ($posts as $post)
      <div class="card w-75 mx-auto text-center mb-3">
        <div class="card-body">
          

          @if(!empty($post->photo->path))
            <img class="img img-fluid" src="{{asset('storage/'.$post->photo->path)}}" alt="{{$post->title}}">
          @endif

          <h4 class="card-tile mb-2">{{$post->title}}</h4>
          <h5 class="card-subtitle mb-2 text-muted"><b>Author: </b>{{$post->user()->first()->name}}</h5>
          <p class="card-text">{{$post->content}}</p>
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
          <h6 class="card-text text-info"><b>Category: </b>{{$post->category()->first()->name}}</h6>
          <div class="row justify-content-center ">
            
            {{-- VIEW POST --}}
            <a class="btn btn-primary" href="{{ route('admin.posts.show', $post) }}">View</a>

            {{-- EDIT POST --}}
            <a class="btn btn-info ml-2" href="{{ route('admin.posts.edit', $post) }}">Modify</a>
            {{-- DELETE POST --}}
            <form class="ml-2" action="{{ route('admin.posts.destroy', $post) }}" method="post">
                @csrf
                @method('DELETE')
                <input class="btn btn-danger" type="submit" value="Delete">
            </form>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="col-12">{{$posts->links()}}</div>
    {{-- FINESTAMPA DATI POST --}}
  </div>
</div>
@endsection