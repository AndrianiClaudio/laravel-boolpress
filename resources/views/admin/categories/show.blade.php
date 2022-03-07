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
    {{-- FINE MESSAGGIO REDIRECT STATUS --}}
    <h2 class="w-100 text-center">All post of Category: {{$categoryName}}</h2>
    <div class="cards">
      @if((count($posts) === 0))
        <h4 class="w-75 mx-auto">Non sono presenti post in questa categoria.</h4>
      @else
        @foreach($posts as $post)
          {{-- @php $categoryMany = $posts->items()[$key]; @endphp --}}
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
                {{-- POST IMAGE --}}
                @if(!empty($post['image']))
                  <img class="d-block mx-auto img img-fluid" src="{{asset('storage/'.$post->image)}}" alt="{{$post->title}}">
                @endif
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
      @endif
      <div class="col-12">
        {{$posts->links()}}
      </div>
    </div>
  </div>
@endsection