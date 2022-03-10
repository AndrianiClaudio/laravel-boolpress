<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Tag;

class TagController extends Controller
{
  public function index()
  {
    $tags = Tag::all();
    return response()->json([
      'response' => true,
      'results' => [
        'data' => $tags
      ],
    ]);
  }
}
