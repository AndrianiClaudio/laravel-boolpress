@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="row">
    {{-- REDIRECT STATUS MESSAGE --}}
    @if (session('status'))
    <div class="col-6 mx-auto">
      <div class="alert alert-danger">
          {{ session('status') }}
      </div>
    </div>
    @endif
    {{-- FINE REDIRECT STATUS MESSAGE --}}
    <h1 class="w-100 text-center">CATEGORIES</h1>
    {{-- DATI CATEGORIES --}}
      
    {{-- STAMPA DATI POST --}}
    <div class="cards mx-auto">
      @foreach ($categories as $category)
      <div class="card text-center mb-3 p-3">
        <div class="card-body">
          <h4 class="card-title">{{$category->name}}</h4>
          <h5 class="card-subtitle mb-2 text-muted"><b>Created: </b>{{$category->created_at}}</h5>
          <div class="row justify-content-center ">
            {{-- VIEW POST --}}
            <a class="btn btn-info" href="{{ route('admin.categories.show', $category->slug) }}">View</a>
            @if($category->slug !== 'generic')
                {{-- EDIT POST --}}
                <a class="btn btn-info ml-2" href="{{ route('admin.categories.edit', $category->slug) }}">Modify</a>
                {{-- DELETE POST --}}
                <form class="ml-2" action="{{ route('admin.categories.destroy', $category->slug) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-danger" type="submit" value="Delete">
                </form>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection