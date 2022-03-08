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
      <h1 class="text-center h1">POSTS</h1>
    </div>
    
    {{-- STAMPA DATI POST --}}
    <div class="cards mx-auto d-flex flex-column align-items-center">
      @foreach ($posts as $post)
        <div class="card w-75 mx-auto mb-3 border-2 rounded">
          <div class="card-body">
            {{-- HEADER   --}}
            @include('partials.main.header')

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
                      <a class="text-decoration-none " href="{{route('admin.tags.show',$tag)}}">
                        <span class="rounded-pill bg-secondary text-light h6 p-2 font-weight-bold text-decoration-none">
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