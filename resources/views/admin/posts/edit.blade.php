@extends('layouts.admin')

@section('content')
<div class="container">
  
  </div>
  <div class="row">
    <div class="col card p-3">
      {{-- {{dd($post)}} --}}
        <h2>Edit {{$post->title}}</h2>
      <form action="{{ route('admin.posts.update',$post->slug) }}" method="POST">
          @csrf
          @method('PATCH')


             <div class="mb-3">
                    <select class="form-select" name="category_id">
                        {{-- se la categoria scelta dall'utente precedentemente e' 
                        identica a quella su cui sto girando inserisco
                        l'attributo selected --}}
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                            {{-- <option {{ old('category_id') == $category->id ? 'selected' : '' }}
                                value="{{ $category->id }}"> --}}
                            <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

          <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
              @error('title')
                  <div class="alert alert-danger">
                      {{ $message }}
                  </div>
              @enderror
          </div>

          <div class="mb-3">
              <label for="content" class="form-label">Content</label>
              <textarea class="form-control" id="content" rows="3"
                  name="content">{{ $post->content }}</textarea>
              @error('content')
                  <div class="alert alert-danger">
                      {{ $message }}
                  </div>
              @enderror
          </div>

          <input class="btn btn-primary" type="submit" value="Salva">
      </form>
      <div class="row">
        <a class='nav-link' href="{{route('admin.posts.show',$post->slug)}}">Show detail post</a>
      </div>
    </div>
  </div>
</div>
@endsection