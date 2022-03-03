@extends('layouts.admin')

@section('content')
    <div class="container">
      @if (session('status'))
      <div class="col">
        <div class="row">
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
        </div>
      </div>
      @endif
      <div class="card">
        <div class="card-title ml-4">
          <h2>All post of Category :{{$category->name}}</h2>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th colspan="3" scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($category->posts()->get() as $post)
                <tr>
                  <td>{{ $post->id }}</td>
                  <td>{{ $post->title }}</td>
                  <td>{{ $post->created_at }}</td>
                  <td>{{ $post->updated_at }}</td>
                  <td><a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
                  </td>
                  <td>
                    <a 
                    class="btn btn-info 
                      @if(Auth::user()->id !== $post->user_id) 
                        disabled
                      @endif"
                    href="{{ route('admin.posts.edit', $post->slug) }}">Modify</a>
                  </td>
                  
                  <td>
                    <form action="{{ route('admin.posts.destroy', $post->slug) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <input 
                      class="btn btn-danger" type="submit" value="Delete"
                      @if(Auth::user()->id !== $post->user_id) 
                      disabled
                    @endif>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
@endsection