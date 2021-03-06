<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index() 
    {
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(3);
        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->views += 1;
        $post->update();


        // $tags = [];
        // foreach ($post->tags as $tag) {
        //     $tags[] = $tag->id;
        // }

        // $similar_posts = Post::where('id', 'in', $tags)->limit(2)->get();
        // dd($similar_posts);
        return view('posts.show', compact('post'));
    }
}
