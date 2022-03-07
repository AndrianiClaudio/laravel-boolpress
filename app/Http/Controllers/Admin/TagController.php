<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Tag;
use App\Model\Post;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('updated_at','desc')->paginate(5);
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
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
        $validate = $request->validate([
            'name' => 'required | alpha_dash | max:240 | unique:App\Model\Tag,name'
        ]);

        $newTag = new Tag();
        $newTag->fill($data);
        $newTag->slug = Post::createSlug($newTag->name,'tag');
        $newTag->save();
        // dd($newTag);
        return redirect()->route('admin.tags.index', Tag::paginate(5))
        ->with('status','Tag '.$newTag->name . ' created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        $tagName = $tag->name;
        $posts = $tag->post()->orderBy('updated_at','desc')->paginate(5);
        // dd($tag,$tagName);
        return view('admin.tags.show',['posts' => $posts,'tagName' => $tagName]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        // dd($request,$tag);
        $data = $request->all();
        $validate = $request->validate([
            'name' => 'required | alpha_dash | max:240 |unique:App\Model\Tag,name'
        ]);

        $tag->name = $data['name'];
        $tag->slug = Post::createSlug($data['name'],'tag');

        $tag->update($data);

        return redirect()
            ->route('admin.tags.show', $tag)
            ->with('status', 'Tag ' . $tag->name . ' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->post()->detach();
        $tag->delete();
        
        return redirect()->route('admin.tags.index')->with('statusError', "Category $tag->name deleted");
    }
}
