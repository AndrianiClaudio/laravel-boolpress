@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div>
    
  </div>
  <div class="row w-75 mx-auto">
    <div class="col card p-3">
        <h2>Create a new Post</h2>
      <form action="{{ route('admin.posts.store') }}" method="POST">
          @csrf
          @method('POST')
        {{-- CATEGORY SELECT --}}
        
        <div class="mb-3">
            <select class="form-select" name='category_id'>
                <option class="" value="">Select a category</option>
                @foreach ($categories as $category)
                    <option 
                    @if(old('category_id') == $category->id) 
                    selected 
                    @endif
                    value="{{$category->id}}">
                        {{$category->name}}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="alert alert-danger mt-3">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        {{-- TAG SELECT --}}
        @php
        $oldTags = [];
        foreach (session()->getOldInput() as $key => $value) {
            if(str_starts_with($key,'tag_id')) {
                $oldTags[] = $value;
            }
        }    
        @endphp
        <div class="mb-3">
            @foreach ($tags as $i => $tag)
            <div class="form-check-inline">
                <input class="form-check-input"
                @if (in_array($i,$oldTags))
                checked
                @endif
                type="checkbox" value="{{$tag->id}}" id="flexCheckDefault-{{$i}}" name="tag_id-{{$i}}"
                >
                <label class="form-check-label" for="flexCheckDefault-{{$i}}">
                    {{$tag->name}}
                </label>
            </div>
            @endforeach
            {{-- @if($errors->any())

                {{dd($tags)}}
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @endif --}}
        </div>

          {{-- TITLE --}}
          <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
              @error('title')
                  <div class="alert alert-danger">
                      {{ $message }}
                  </div>
              @enderror
          </div>

          {{-- CONTENT --}}
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