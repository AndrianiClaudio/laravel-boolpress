<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
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
        // $posts = $posts->where('id', 16)->with('tag', 'category', 'user')->get();
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

    public function inRandomOrder()
    {
        // dd('-------');
        $posts = Post::inRandomOrder()->with('tag', 'category', 'user')->limit(4)->get();

        return response()->json([
            'response' => true,
            'results' => [
                'data' => $posts
            ],
        ]);
    }

    /**
     * Summary of search
     * @param Request $request
     * @return void
     */
    public function filter(Request $request)
    {
        $data = $request->all();
        //apriamo una chiamata eloquent senza chiuderla
        $posts = Post::where('id', '>=', 1);

        if (array_key_exists('category', $data)) {
            if ($data['category'] !== 'all') {
                $category = $data['category'];
                $posts->whereHas('category', function (Builder $query) use ($category) {
                    $query->where('name', $category);
                // dd($query)
                });
            }
        }
        if (array_key_exists('tags', $data) && $data['tags']) {
            // dd($data['tags']);
            // dd(explode("-", $data['tags']));
            if ($data['tags'] != '""') {
                foreach (explode("-", $data['tags']) as $tag) {
                    //fa una join per controllare le category che sono associati al post
                    $posts->whereHas('tag', function (Builder $query) use ($tag) {
                        $query->where('name', $tag);
                    });
                }
            }
        }

        $posts = $posts->with(['tag', 'category', 'user'])->get();
        // dd($posts);
        return response()->json([
            // ($posts->count() === 0) ? $posts : null
            'response' => true,
            'count' => $posts->count(),
            'results' => [
                'data' => ($posts->count() === 0) ? null : $posts,
            ],
        ]);
    }
}
