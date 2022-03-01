@extends('layouts.admin')

@section('content')
<div class="container">
  <div>
    
  </div>
  <div class="row">
    <div class="col card p-3">
        <h2>Create a new Post</h2>
      <form action="{{ route('admin.posts.store') }}" method="POST">
          @csrf
          @method('POST')

          <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
              @error('title')
                  <div class="alert alert-danger">
                      {{ $message }}
                  </div>
              @enderror
          </div>

          <div class="mb-3">
              <label for="content" class="form-label">Content</label>
              <textarea class="form-control" id="content" rows="3"
                  name="content">{{ old('content') }}</textarea>
              @error('content')
                  <div class="alert alert-danger">
                      {{ $message }}
                  </div>
              @enderror
          </div>

          <input class="btn btn-primary" type="submit" value="Salva">
      </form>
    </div>
  </div>
</div>
@endsection