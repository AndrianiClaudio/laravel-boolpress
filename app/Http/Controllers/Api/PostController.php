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

        // AGGIUNGO AI POST CATEGORY E TAGS
        $posts->with('tag', 'category', 'user')->get();

        // chiudiamo posts
        // $posts = $posts->get();
        $posts = $posts->paginate(8);

        return response()->json([
            'response' => 'true',
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
        $post = Post::find($id);

        return response()->json([
            'response' => 'true',
            'count' => $post ? 1 : 0,
            'results' => [
                'data' => $post,
            ]
        ]);
    }
}
