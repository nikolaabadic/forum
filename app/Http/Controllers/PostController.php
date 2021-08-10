<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->paginate(10);
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function store(Topic $topic, Request $request){
        $this->validate($request,[
            'body' => 'required'
        ]);

        $request -> user() -> posts() -> create([
            'body'=> $request-> body,
            'topic_id' => $topic -> id
        ]);

        return back();
    }

    public function destroy(Post $post){
        $this->authorize('delete', $post);
        $post->delete();
        return back();
    }
}
