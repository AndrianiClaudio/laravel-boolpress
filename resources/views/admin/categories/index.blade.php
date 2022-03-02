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
    <div class="col">
        <div class="container">
            <h1>CATEGORIES</h1>
            <nav class="navbar navbar-inline">
                <a href="{{route('admin.categories.create')}}" class="nav-link">Create a new Post</a>
            </nav>
        </div>
    </div>
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
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td><a class="btn btn-primary" href="{{ route('admin.categories.show', $category->slug) }}">View</a>
                    </td>
                    {{-- <td><a class="btn btn-info" href="{{ route('admin.categories.edit', $category->slug) }}">Modify</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.categories.destroy', $category->slug) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Delete">
                        </form>

                    </td> --}}
                </tr>
            @endforeach


        </tbody>
    </table>
</div>
@endsection