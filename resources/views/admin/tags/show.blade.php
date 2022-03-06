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

    <h2 class="w-100 text-center">All post with #{{$tagName}}</h2>
    {{-- FINE MESSAGGIO REDIRECT STATUS --}}
    <div class="cards">
      @if (count($posts) === 0)
      <h4 class="w-75 mx-auto text-center">Non sono presenti post con questo tag.</h4>
      @else
        @foreach ($posts->toArray()['data'] as $key => $post)
        @php $postMany = $posts->items()[$key]; @endphp
        <div class="card w-75 mx-auto text-center mb-3">
          <div class="card-title ml-4 mt-2">
            <h2><b>Title: </b>{{$post['title']}}</h2>
          </div>
          <div class="card-body pt-0">
            <h3>Category: {{$postMany->category()->first()->name}}</h3>
            <h4>Author: {{$postMany->user()->first()->name}}</h3>
            <p><b>Content: </b>{{$post['content']}}</p>
            
            @if(count($postMany->tag()->get()) > 0)
              <div class="row align-items-center">
                <div class="col-2">
                  <b>Tags: </b>
                </div>
                <div class="col-10">
                  <ul class="list-group list-group-horizontal flex-wrap mx-auto">
                  @foreach ($postMany->tag()->get()->toArray() as $tags)
                    <li class="list-group-item border-0">#{{$tags['name']}}</li>
                  @endforeach
                  </ul>
                </div>
              </div>
            @endif

            <b>Created: {{$post['created_at']}}</b><br>
            <b>Last update: {{$post['updated_at']}}</b>
            @if(Auth::user()->id === $post['user_id'])
            <hr>
              <div class="row align-items-center justify-content-center text-center">
                <a class='btn btn-info' href="{{route('admin.posts.edit',$post['slug'])}}">Edit Post</a>
              
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
    </div>
    <div class="col-12">
      {{$posts->links()}}
    </div>
  </div>
@endsection