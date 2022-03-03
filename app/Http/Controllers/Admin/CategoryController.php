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
        $categories = Category::orderBy('name','asc')->get();
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
        // dd($request->all());
        $validate = $request->validate([
            'name' => 'required | max:240'
        ]);

        $newCategory->fill($data);
        $newCategory->slug = Post::createSlug($newCategory->name);

        $newCategory->save();

        return redirect()
            ->route('admin.categories.show', $newCategory->slug)
            ->with('status', 'ategory' . $newCategory->name . 'created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // dd($category);
        return view('admin.categories.show', compact('category'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // dd($category);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('status', "Category $category->name deleted");

        // category->update ->setGeneric
    }
}
