<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function add(Request $request)
    {
        $id = Auth::user()->id;
        $post = new Post();
        if ($image = $request->file('image')) {
            $image_name = time() . $image->getClientOriginalName();
            $image->move('assets/posts/images/', $image_name);
            $post->image = $image_name;
        }
        $post->author_id = $id;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->title = $request->input('title');
        $post->save();
        return redirect('/home')->with('status', 'Post added successfully');
    }
    public function edit($id) // get edit route
    {
        $post = Post::find($id);
        return view('editPost', compact('post'));
    }
    public function update(Request $request, $id) //post edit route
    {
        $post = Post::find($id);
        if ($image = $request->file('image')) {
            $image_name = time() . $image->getClientOriginalName();
            $image->move('assets/posts/images/', $image_name);
            $post->image = $image_name;
        }
        $post->author_id = $id;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->title = $request->input('title');
        $post->save();
        return redirect('/home')->with('status', 'Post edited successfully');
    }
    public function delete($id)
    {
        Post::find($id)->delete();
        return redirect('/home')->with('status', 'Post deleted successfully');
    }
}
