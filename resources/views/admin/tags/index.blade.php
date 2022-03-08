@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="row">
    {{-- REDIRECT STATUS MESSAGE --}}
    @if (session('status'))
    <div class="col-6 mx-auto">
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    </div>
    @endif
    {{-- FINE REDIRECT STATUS MESSAGE --}}
    <h1 class="w-100 text-center">TAGS</h1>
    {{-- DATI CATEGORIES --}}
    
    {{-- STAMPA DATI TAG --}}
    <div class="cards w-75 mx-auto d-flex flex-column align-items-center">
      @foreach ($tags as $tag)
        <div class="card tags text-center mb-3 p-3">
          <div class="card-body">
            <h4 class="card-title text-uppercase h3">
              <a class="text-decoration-none text-success" href="{{route('admin.tags.show',$tag)}}">
                <em>
                  #{{$tag->name}}
                </em>
              </a>
            </h4>
            <h5 class="card-subtitle mb-2 text-muted"><b>Created: </b>{{$tag->created_at}}</h5>
          </div>
          <div class="d-flex justify-content-center">
            {{-- EDIT POST --}}
            <a class="btn ms-2 text-primary" href="{{ route('admin.tags.edit', $tag->slug) }}"><i class="bi bi-pen"></i></a>
            {{-- DELETE POST --}}
            <form class="ms-2" action="{{ route('admin.tags.destroy', $tag->slug) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn" type="submit">
                  <i class="d-block bi bi-trash text-danger"></i>
                </button>
            </form>
          </div>
        </div>

      @endforeach
      <div class="col-3 mx-auto mb-3">
        {{$tags->links()}}
      </div>
    </div>
  </div>
</div>
@endsection