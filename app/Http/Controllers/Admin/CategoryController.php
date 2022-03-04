<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Category;
use App\Model\Post;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name','asc')->paginate(5);
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newCategory = new Category;
        $data = $request->all();

        // VALIDAZIONE
        $validate = $request->validate([
            'name' => 'required | max:240'
        ]);

        $newCategory->fill($data);
        $newCategory->slug = Post::createSlug($newCategory->name);
        $newCategory->save();

        return redirect()
            ->route('admin.categories.show', $newCategory->slug)
            ->with('status', 'Category ' . $newCategory->name . ' created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // dd($category);
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->all();

        $validate = $request->validate([
            'name' => 'required | max:240'
        ]);

        if($data['name'] != $category->name) {
            $category->name = $data['name'];
            $category->slug = Post::createSlug($data['name']);
        }
        $category->update($data);

        return redirect()
            ->route('admin.categories.show', $category->slug)
            ->with('status', 'category ' . $category->name. ' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $generic_id = Category::where('name', 'generic')->first()->id;
        $post_change_id = Post::where('category_id', $category->id)->get();
        $category->delete();
        foreach($post_change_id as $post) {
            $post->category_id = $generic_id;
            $post->save(['category_id']);
        }

        return redirect()->route('admin.categories.index')->with('status', "Category $category->name deleted");
    }
}
