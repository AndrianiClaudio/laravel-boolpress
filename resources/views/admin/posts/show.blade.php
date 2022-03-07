@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
      {{-- MESSAGGIO REDIRECT STATUS --}}
      @if (session('status'))
      <div class="col-6 mx-auto">
        <div class="row">
          <div class="alert alert-success mx-auto">
            {{ session('status') }}
          </div>
        </div>
      </div>
      @endif
      {{-- FINE MESSAGGIO REDIRECT STATUS --}}

      <div class="card w-75 mx-auto text-center ">
        <div class="card-title ml-4 mt-2">


          @if(!empty($post->photo->path))
            <img class="img img-fluid" src="{{asset('storage/'.$post->photo->path)}}" alt="{{$post->title}}">
            {{-- @dd(asset('storage/'.$post->photo)) --}}
            {{-- @dd($post->photo) --}}
          @endif

          <h2><b>Title: </b>{{$post->title}}</h2>
        </div>
        <div class="card-body pt-0">
          <h3>Category: {{$post->category()->first()->name}}</h3>
          <h4>Author: {{$post->user()->first()->name}}</h3>
          <p><b>Content: </b>{{$post->content}}</p>
          @if(count($post->tag()->get()) > 0)
            <div class="row align-items-center">
              <div class="col-2">
                <b>Tags: </b>
              </div>
              <div class="col-10">
                <ul class="list-group list-group-horizontal flex-wrap  mx-auto">
                @foreach ($post->tag()->get() as $tag)
                  <li class="list-group-item border-0">#{{$tag->name}}</li>
                @endforeach
                </ul>
              </div>
            </div>
          @endif
          <b>Created: {{$post->created_at}}</b><br>
          <b>Last update: {{$post->updated_at}}</b>
          @if($post->user_id === Auth::user()->id)
          <hr>
          <div class="row align-items-center justify-content-center text-center">

            <a class='btn btn-info ml-3' href="{{route('admin.posts.edit',$post->slug)}}">Edit Post</a>
          
            {{-- Delete this post --}}
            <form action="{{ route('admin.posts.destroy', $post->slug) }}" method="post">
              @csrf
              @method('DELETE')
              <input class="btn btn-danger ml-3" type="submit" value="Delete">
            </form>
          </div>
          @endif
        </div>
      </div>
    </div>
@endsection