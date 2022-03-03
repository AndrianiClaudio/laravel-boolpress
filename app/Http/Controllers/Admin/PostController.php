<?php

namespace App\Http\Controllers\Admin;


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
        
        // VALIDATE
        $validate = $request->validate(
            [
                'title' => 'required|max:255',
                'content' => 'required',
                'category_id' => 'exists:App\Model\Category,id'
                ]
            );


        // CREATE NEW POST
        $newPost = new Post();
        $newPost->fill($data);
        $newPost->user_id = Auth::id();
        $newPost->slug = Post::createSlug($data['title']);
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
        $categories = Category::all();
        // dd($post->toArray());
        return view('admin.posts.edit',[
            'post' => $post,
            'categories' => $categories,
        ]);
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
        $data = $request->all();

        $validate = $request->validate(
            [
                'title' => 'required|max:255',
                'content' => 'required',
                'category_id' => 'exists:App\Model\Category,id'
                ]);


        $changes = [false, false, false];
        // CHECK & UPDATE IF WE HAVE ANY CHANGE
        if ($data['title'] != $post->title) {
            $post->title = $data['title'];
            $post->slug = Post::createSlug($data['title']);
            $changes[0] = true;
        }
        if ($data['content'] != $post->content) {
            $post->content = $data['content'];
            $changes[1] = true;
        }
        if ($data['category_id'] != $post->category_id) {
            $post->category_id = $data['category_id'];
            $changes[2] = true;
        }

        $post->update($data);

        // CHANGE MESSAGES IF DATA CHANGES OR NOT
        $messages = [
            "Post $post->title updated with 0 changes",
            "Post $post->title updated"
        ];
        if(array_search(true,$changes)  === false){
            $i_messages = 0;
        } else {
            $i_messages = 1;
        }

        return redirect()
            ->route('admin.posts.show', $post->slug)
            ->with('status', $messages[$i_messages]);
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
