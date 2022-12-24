<?php

namespace App\repositories;

use App\Interfaces\PostInterface;
use App\Models\Post;
use Illuminate\Http\Request;
use Auth;
class PostRepository implements PostInterface {
    public function read()
    {
        $posts = Post::all();
        return view('posts.index' , compact('posts'));
    }

    public function readSinglePost($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show' , compact('post'));
    }

    public function store(Request $request)
    {
        $post = Post::create([
            'description' => $request->get('description'),
            'user_id' => Auth::user()->id
        ]);

        return redirect('/posts.show'.$post->id);
    }


    public function create()
    {
        return view('posts.create');
    }

    public function update(Request $request , $id , Post $post) {
        $this->authorize('update', $post);
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return redirect('posts/'.$post->id);
    }
}
