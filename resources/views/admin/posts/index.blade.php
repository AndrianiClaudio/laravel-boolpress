@extends('layouts.app')

@section('content')
<div class="container">
  {{-- ti trovi in index.blade.php --}}
  <ul>
    @foreach ($posts as $post)
    <li>
      <h2>{{$post->title}}</h2>
      <p>{{$post->content}}</p>
      <b>Date: {{$post->created_at}}</b>
    </li>
    @endforeach
  </ul>
          
  {{$posts->links()}}
</div>
@endsection