<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Post;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'response' => true,
            'results' => [
                'data' => $categories
            ],
        ]);
    }

    public function show($id) {
        $post = Post::where('category_id', $id);

        // AGGIUNGO POST USER,CATEGORY E TAGS
        $post = $post->with('tag', 'category', 'user')->get();
        // dd($post);
        // $post = $post->get();
        return response()->json([
            'response' => 'true',
            'count' => $post->count(),
            'results' => [
                'data' => $post,
            ]
        ]);
    }
}
