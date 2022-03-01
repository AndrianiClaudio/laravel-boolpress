@extends('layouts.admin')

@section('content')
<div class="container">
  {{-- ti trovi in index.blade.php --}}
  <div class="row">
    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @endif
    <div class="col">
        <div class="container">
            <h1>POSTS</h1>
            <nav class="navbar navbar-inline">
                <a href="{{route('admin.posts.create')}}" class="nav-link">Create a new Post</a>
            </nav>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th colspan="3" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td><a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
                    </td>
                    <td><a class="btn btn-info" href="{{ route('admin.posts.edit', $post->slug) }}">Modify</a>
                    </td>
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
</div>

  {{-- <ul> --}}
    {{-- {{dd($posts->toArray())}} --}}
    {{-- @foreach ($posts->toArray() as $post)
    <li>
      <h2>{{$post['title']}}</h2>
      <p>{{$post['content']}}</p>
      <b>Date: {{$post['created_at']}}</b>
    </li>
    @endforeach
  </ul> --}}
</div>
@endsection