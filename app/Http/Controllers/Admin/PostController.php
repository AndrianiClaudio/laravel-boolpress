<?php

namespace App\Http\Controllers\Admin;


use App\Model\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Category;
use App\Model\Tag;
use Illuminate\Support\Facades\Storage;
use App\Model\Photo;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at','desc')->where('user_id', '=', Auth::id())->paginate(5);
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
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories'),compact('tags'));
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
                'category_id' => 'exists:App\Model\Category,id',
                'photo' => 'nullable|image'
                ]
            );
        // SPLIT & GET TAGS
        $tags = [];
        foreach ($data as $key => $value) {
            if(str_starts_with($key,'tag_id')) {
                $tags[] = $value;
            }
        }
        
        // CREATE NEW POST
        $newPost = new Post();
        

        // dd($data);
        $newPost->fill($data);
        $newPost->user_id = Auth::id();
        $newPost->slug = Post::createSlug($data['title'],'post');

        if(!empty($data['photo'])) {
            $img_path = Storage::put('uploads/posts', $data['photo']);
            $newPost['image'] = $img_path;
        }
        $newPost->save();


        Post::where('slug', $newPost->slug)->first()->tag()->attach($tags);
        
        return redirect()->route('admin.posts.show', $newPost->slug)->with('status','Post '.$newPost->title . ' created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show',['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {



        $tags = Tag::all();
        // dd($post->tag(), $tags);
        $categories = Category::all();
        return view('admin.posts.edit',[
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        $validate = $request->validate(
            [
                'title' => 'required|max:255',
                'content' => 'required',
                'category_id' => 'exists:App\Model\Category,id',
                'photo' => 'nullable'
                ]);

        $changes = [false, false, false];
        // CHECK & UPDATE IF WE HAVE ANY CHANGE
        if ($data['title'] != $post->title) {
            $post->title = $data['title'];
            $post->slug = Post::createSlug($data['title'],'post');
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
        

        $post->update();
        
        // dd($post->photo->path)
        if(!empty($data['photo'])) {
            // dd($data['photo']);
            dd($post->photo->path);
            Storage::delete($post->photo->path);
            // dd($data['photo']);
            $img_path = Storage::put('uploads/posts', $data['photo']);
            $post->photo->path = $img_path;
            // $post->save();
            // $image = $post->photo()->first();
            // $image->path = $img_path;
            // $image->slug = Str::slug(explode('/',$img_path)[2].'_'.$newPost->slug,'-');
            // $image->update();
            // $newImage = new Photo();
            // $newImage->path = $img_path;
            // $newImage->slug = Str::slug(explode('/',$img_path)[2].'_'.$newPost->slug,'-');
            // $newImage->post_id = $newPost->id;
            // $newImage->save();
            // dd($newImage);
        }
  

        $tags = [];
        foreach ($data as $key => $value) {
            if(str_starts_with($key,'tag_id')) {
                $tags[] = $value;
            }
        }
        // $tags = $post->tag()->get();
        
        Post::where('slug', $post->slug)->first()->tag()->sync($tags);

        return redirect()
            ->route('admin.posts.show', $post->slug)
            ->with('status', 'Post '. $post->title .' updated.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tag()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index')->with('statusError', "Post $post->title deleted");
    }

}
