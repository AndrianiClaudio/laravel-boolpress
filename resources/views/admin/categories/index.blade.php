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
    <h1>CATEGORIES</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                {{-- <th scope="col">Id</th> --}}
                <th scope="col">Name</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                {{-- <th colspan="3" scope="col">Actions</th> --}}
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    {{-- <td>{{ $category->id }}</td> --}}
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td><a class="btn btn-primary" href="{{ route('admin.categories.show', $category->slug) }}">View</a>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection