@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="row">
    {{-- MESSAGGIO REDIRECT STATUS ERROR --}}
    @if (session('statusError'))
      <div class="col-6 mx-auto">
        <div class="alert alert-danger mx-auto">
          {{ session('statusError') }}
        </div>
      </div>
    {{-- FINE MESSAGGIO REDIRECT STATUS ERROR --}}
    @endif
    <div class="col-12">
      <h1 class="text-center h1 text-danger">POSTS</h1>
    </div>
    
    {{-- STAMPA DATI POST --}}
    <div class="cards w-100 mx-auto">
      @foreach ($posts as $post)
        <div class="card w-75 mx-auto mb-3 border-2 rounded">
          <div class="card-body">
            {{-- HEADER   --}}
            <header class="header">
              <div class="row justify-content-between">
                {{-- POST TITLE --}}
                <div class="col">
                  <h2 class="card-tile mb-2 h2">
                    {{-- VIEW POST --}}
                    <a class="text-dark text-uppercase" href="{{ route('admin.posts.show', $post) }}">
                      {{$post->title}}
                    </a>
                  </h2>
                </div>
                {{-- EDIT & DELETE --}}
                <ul class="list-inline">
                  {{-- EDIT POST --}}
                  <li class="list-inline-item">
                    <a class="btn text-success ml-2" href="{{ route('admin.posts.edit', $post) }}" title="Edit {{$post->title}}">
                      <i class="bi bi-pen"></i>
                    </a>
                  </li>
                  {{-- DELETE POST --}}
                  <li class="list-inline-item">
                    <form class="" action="{{ route('admin.posts.destroy', $post) }}" method="post" title="Delete {{$post->title}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit">
                          <i class="d-block bi bi-trash text-danger"></i>
                        </button>
                    </form>
                  </li>
                </ul>
              </div>
              <div class="row">
                <div class="col">
                  {{-- CATEGORY & AUTHOR --}}
                  <div class="d-flex justify-content-between align-items-center">
                    {{-- CATEGORY  --}}
                    <span class="card-text text-info h5">
                      {{$post->category()->first()->name}}
                    </span>
                    {{-- POST AUTHOR --}}
                    <span class="card-subtitle mb-2 text-muted">
                      Created by {{$post->user()->first()->name}} - {{$post->created_at->format('d-m-Y H:i')}}.
                    </span>
                  </div>
                </div>
              </div>
            </header>
            {{-- FINE HEADER  --}}
            <hr class="bg-primary">
              {{-- POST IMAGE --}}
              @if(!empty($post['image']))
                <img class="img img-fluid" src="{{asset('storage/'.$post->image)}}" alt="{{$post->title}}">
              @endif
            {{-- POST CONTENT --}}
            <p class="card-text h4">
              <em>
                {{$post->content}}
              </em>
            </p>
            <hr class="bg-primary">
            {{-- POST TAGS --}}
            @if(count($post->tag()->get()) > 0)
              <div class="row">
                <div class="col">
                  <ul class="list-group list-group-horizontal flex-wrap mx-auto">
                  @foreach ($post->tag()->get() as $tag)
                    <li class="list-group-item border-0">
                      <a href="{{route('admin.tags.show',$tag)}}">
                        <span class="rounded-pill bg-light text-dark h6 p-2 font-weight-bold text-decoration-none">
                          #{{$tag->name}}
                        </span>
                      </a>
                    </li>
                  @endforeach
                  </ul>
                </div>
              </div>
            @endif
          </div>
        </div>
      @endforeach
    </div>
    {{-- LINKS PAGINATE --}}
    <div class="col-12">{{$posts->links()}}</div>
    {{-- FINESTAMPA DATI POST --}}
  </div>
</div>
@endsection