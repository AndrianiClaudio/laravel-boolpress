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
                <th scope="col" colspan="3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>

                    @php
                    $check = 'disabled';
                    if ($post->user_id === Auth::id()) {
                      $check = '';
                    }
                    @endphp
                    
                    <td>
                      <a class="btn btn-primary" href="@if($check === ''){{ route('admin.posts.show', $post->slug) }}@else {{route('guest.posts.show',$post->slug)}}@endif">View</a>
                    </td>

                    <td>
                      <a class="btn btn-info {{$check}}" href="{{ route('admin.posts.edit', $post->slug) }}">Modify</a>
                    </td>
                    <td>
                      @if($check === 'disabled')
                      <fieldset disabled>
                      @else
                      @endif
                        <form action="{{ route('admin.posts.destroy', $post->slug) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <input class="btn btn-danger" type="submit" value="Delete">
                        </form>
                      
                      @if($check === 'disabled')
                      </fieldset>
                      @endif

                    </td> 
                </tr>
            @endforeach


        </tbody>
    </table>
    <div class="col">{{$posts->links()}}</div>
</div>
@endsection
