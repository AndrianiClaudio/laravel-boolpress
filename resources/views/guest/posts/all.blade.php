@php
    $path = Auth::check() ? 'admin' : 'app';
@endphp

@extends('layouts/' . $path)

@section('content')
<div class="container">
  <h1>All Boolpress Posts</h1>
      <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    @if ($post->user_id === Auth::id())
                    <td><a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
                    </td>
                    @else
                    
                    <td></td>
                    <td></td>
                    
                    <td><a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
                    </td>
                    
                    @endif
                    {{-- {{dd(Auth::check())}} --}}
                    @if ($post->user_id === Auth::id())
                      <td><a class="btn btn-info" href="{{ route('admin.posts.edit', $post->slug) }}">Modify</a>
                      </td>
                      <td>
                        <form action="{{ route('admin.posts.destroy', $post->slug) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <input class="btn btn-danger" type="submit" value="Delete">
                        </form>
                        
                      </td>
                    @endif
                </tr>
            @endforeach


        </tbody>
    </table>
    <div class="col">{{$posts->links()}}</div>
</div>
@endsection
