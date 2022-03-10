<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc');

        // AGGIUNGO AI POST USER, CATEGORY E TAGS
        $posts = $posts->with('tag', 'category', 'user')->paginate(8);

        // dd($posts);
        return response()->json([
            'response' => 'true',
            'count' => $posts->total(),
            'results' => $posts
        ]);
    }


    /**
     * 
     * @param mixed $id
     * @return void
     */
    public function show($id)
    {
        // dd($id);
        $post = Post::where('id', $id);

        // AGGIUNGO POST USER,CATEGORY E TAGS
        $post = $post->with('tag', 'category', 'user')->get();
        // dd($post);
        $post = $post->first();
        return response()->json([
            'response' => 'true',
            'count' => $post ? 1 : 0,
            'results' => [
                'data' => $post,
            ]
        ]);
    }
}
