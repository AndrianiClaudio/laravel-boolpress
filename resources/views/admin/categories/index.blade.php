@extends('layouts.admin')

@section('content')
<div class="container">
  {{-- ti trovi in index.blade.php --}}
  <div class="row">
    @if (session('status'))
    <div class="col-12">
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    </div>
    @endif
    <header>
        <h1>CATEGORIES</h1>
        <nav class="navbar navbar-inline">
            <a href="{{route('admin.categories.create')}}" class="nav-link">Create a new Category</a>
        </nav>
    </header>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col" colspan="3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    {{-- VIEW --}}
                    <td><a class="btn btn-primary" href="{{ route('admin.categories.show', $category->slug) }}">View</a>
                    </td>
                    {{-- EDIT --}}
                    <td><a class="btn btn-info
                        @if($category->slug === 'generic')
                            disabled
                        @endif" href="{{ route('admin.categories.edit', $category->slug) }}">Edit</a>
                    </td>
                    {{-- DELETE --}}
                    <td>
                        <form action="{{ route('admin.categories.destroy', $category->slug) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <input class="btn btn-danger" type="submit" value="Delete" 
                          @if($category->slug === 'generic')
                            disabled
                          @endif>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection