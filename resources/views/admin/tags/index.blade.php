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
    <div class="cards w-75 mx-auto">
      @foreach ($tags as $tag)
        <div class="card tags text-center mb-3 p-3">
          <div class="card-body">
            <h4 class="card-title">#{{$tag->name}}</h4>
            <h5 class="card-subtitle mb-2 text-muted"><b>Created: </b>{{$tag->created_at}}</h5>
          </div>
          {{-- VIEW TAG --}}
          <div class="col mx-auto">
            <a class="btn btn-primary" href="{{ route('admin.tags.show', $tag) }}">View</a>
            {{-- EDIT TAG --}}
            <a class="btn btn-info ml-2" href="{{ route('admin.tags.edit', $tag) }}">Modify</a>
            <a class="btn btn-danger ml-2" href="{{ route('admin.tags.destroy', $tag->slug) }}"
            onclick="event.preventDefault();
            document.getElementById('delete-form').submit();">Delete</a>
            {{-- DELETE TAG --}}
                              
            <form class="ml-2 d-none" id="delete-form" action="{{ route('admin.tags.destroy', $tag->slug) }}" method="post">
                @csrf
                @method('DELETE')
                <input class="btn btn-danger" type="submit" value="Delete">
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