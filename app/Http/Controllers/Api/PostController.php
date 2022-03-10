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
    { // $posts = Post::all();
        $posts = Post::orderBy('updated_at', 'desc')->paginate(8);
        // $posts = Post::all();
        // dd($posts->toArray());
        // dd($posts['next_page_url']);
        foreach ($posts as $post) {
            $tags = [];
            $post['author'] = $post->user()->first()->name;
            $post['category'] = $post->category()->first()->name;
            foreach ($post->tag()->get()->toArray() as $tag) {
                $tags[] = $tag['name'];
            }
            $post['tags'] = $tags;
        }
        return response()->json([
            'response' => 'true',
            'results' => [
                'posts' => $posts,

            ]
        ]);
    // dd('Api Post controller --- index');
    }



}
