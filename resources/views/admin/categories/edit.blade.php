@extends('layouts.admin')

@section('content')
<div class="container">

  <div class="row">
    <div class="col card p-3">
        <h2>Edit category {{$category->name}}</h2>
      <form action="{{ route('admin.categories.update',$category) }}" method="POST">
          @csrf
          @method('PATCH')
          {{-- NUOVA CATEGORY --}}
          <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
              @error('name')
                  <div class="alert alert-danger">
                      {{ $message }}
                  </div>
              @enderror
          </div>
          {{-- FINE NUOVA CATEGORY --}}
          <input class="btn btn-primary" type="submit" value="Salva">
      </form>
    </div>
  </div>
</div>
@endsection