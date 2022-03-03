@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row">
    {{-- MESSAGGIO REDIRECT STATUS --}}
    @if (session('status'))
    <div class="col-12">
      <div class="alert alert-danger">
        {{ session('status') }}
      </div>
    </div>
    {{-- FINE MESSAGGIO REDIRECT STATUS --}}
    @endif
    <header>
      <h1>POSTS</h1>
      <nav class="navbar navbar-inline">
        <a href="{{route('admin.posts.create')}}" class="nav-link">Create a new Post</a>
      </nav>
    </header>
    
    {{-- STAMPA DATI POST --}}
    <table class="table table-striped">
      {{-- TABLE HEAD --}}
      <thead>
          <tr>
              <th scope="col">Title</th>
              <th scope="col">Author</th>
              <th scope="col">Category</th>
              <th scope="col">Created At</th>
              <th scope="col">Updated At</th>
              <th colspan="3" scope="col">Actions</th>
          </tr>
      </thead>
      {{-- TABLE BODY --}}
      <tbody>
          @foreach ($posts as $post)
            <tr>
              <td>{{ $post->title }}</td>
              <td>{{ $post->user()->first()->name }}</td>
              <td>{{ $post->category()->first()->name }}</td>
              <td>{{ $post->created_at }}</td>
              <td>{{ $post->updated_at }}</td>
              {{-- VIEW --}}
              <td><a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
              </td>
              {{-- EDIT --}}
              <td><a class="btn btn-info" href="{{ route('admin.posts.edit', $post->slug) }}">Modify</a>
              </td>
              {{-- DELETE --}}
              <td>
                  <form action="{{ route('admin.posts.destroy', $post->slug) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <input class="btn btn-danger" type="submit" value="Delete">
                  </form>
              </td>
            </tr>
          @endforeach
        </tbody>
    </table>
    <div class="col">{{$posts->links()}}</div>
    {{-- FINESTAMPA DATI POST --}}
  </div>
</div>
@endsection