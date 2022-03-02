<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;

use App\Model\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::paginate(5);
        $posts = Post::orderBy('updated_at','desc')->where('user_id', '=', Auth::id())->paginate(10);

        // dd($posts);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $slug = Str::slug($data['title'], '-');
        
        $postPresente = Post::where('slug', $slug)->first();

        $counter = 0;
        while ($postPresente) {
            $slug = $slug . '-' . $counter;
            $postPresente = Post::where('slug', $slug)->first();
            $counter++;
        }

        
        $validate = $request->validate(
            [
                'title' => 'required|max:255',
                'content' => 'required',
                'category_id' => 'exists:App\Model\Category,id'
                ]
            );
        $newPost = new Post();

        // $newPost->user_id = Auth::id();
        $newPost->fill($data);
        $newPost->slug = $slug;
        $newPost->save();

        // dd($newPost);
        return redirect()->route('admin.posts.show', $newPost->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // dd('Post show', $post);
        return view('admin.posts.show',['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // dd($post->toArray());
        return view('admin.posts.edit',['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // dd($request->all());
        $validateData = $request->all();

        $post->update($validateData);
        // dd($post);
        // dd($newPost);
        return redirect()->route('admin.posts.show', $post->slug)->with('status', "Post $post->title updated");;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', "Post $post->title deleted");
    }

}
