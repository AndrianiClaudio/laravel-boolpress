@extends('layouts.admin')

@section('content')
  <div class="container-fluid">
    {{-- MESSAGGIO REDIRECT STATUS --}}
    @if (session('status'))
      <div class="row">
        <div class="col-6 mx-auto">
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        </div>
      </div>
    @endif
    {{-- FINE MESSAGGIO REDIRECT STATUS --}}
    <h2 class="w-100 text-center">All post of Category: {{$categoryName}}</h2>
    <div class="cards text-center">
      @if((count($posts) === 0))
        <h4 class="w-75 mx-auto">Non sono presenti post in questa categoria.</h4>
      @else
        @foreach($posts->toArray()['data'] as $key => $post)
          @php $categoryMany = $posts->items()[$key]; @endphp
          <div class="card w-75 mx-auto text-center mb-3">
            <div class="card-title ml-4 mt-2">
              <h2><b>Title: </b>{{$post['title']}}</h2>
            </div>
            <div class="card-body pt-0">
              <h4>Author: {{$categoryMany->user()->first()->name}}</h3>
              <p><b>Content: </b>{{$post['content']}}</p>
              @if(count($categoryMany->tag()->get()) > 0)
                <div class="row align-items-center">
                  <div class="col-2">
                    <b>Tags: </b>
                  </div>
                  <div class="col-10">
                    <ul class="list-group list-group-horizontal flex-wrap  mx-auto">
                    @foreach ($categoryMany->tag()->get() as $tag)
                      <li class="list-group-item border-0">#{{$tag->name}}</li>
                    @endforeach
                    </ul>
                  </div>
                </div>
              @endif
              <b>Created: {{$post['created_at']}}</b><br>
              <b>Last update: {{$post['updated_at']}}</b>
              {{-- @dd($post) --}}
              @if(Auth::user()->id === $post['user_id'])
              <hr>
                <div class="row align-items-center justify-content-center text-center">
                  <a class='btn btn-info' href="{{route('admin.posts.edit',$post['slug'])}}">Edit Post</a>
                
                  {{-- Delete this post --}}
                  <form action="{{ route('admin.posts.destroy', $post['slug']) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-danger ml-3" type="submit" value="Delete">
                  </form>
                </div>
              @endif
            </div>
          </div>
        @endforeach
      @endif
      <div class="col-12">
        {{$posts->links()}}
      </div>
    </div>
  </div>
@endsection