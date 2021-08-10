<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index(){
        $topics = Topic::latest()->paginate(10);
        return view('topics.index', [
            'topics' => $topics
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'title' => 'required'
        ]);

        $request -> user() -> topics() -> create([
            'title'=> $request-> title
        ]);

        return back();
    }

    public function destroy(Topic $topic){
        $this->authorize('delete', $topic);
        $topic->delete();
        return back();
    }

    public function get(Topic $topic){
        $posts = Post::where('topic_id', $topic -> id)->latest()->paginate(10);
        return view('posts.index', [
            'posts' => $posts,
            'topic' => $topic
        ]);
    }
}
