<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    //

    public function posts(Request $request)
    {
        $email = $request->input('email');
        $pass = $request->input('password');
        $user = User::where('email' , $email)->first();
        Hash::check($pass, $user->password);

        $posts = [];
        if ($user->role_as == '1') {
            $posts = Post::all();
        } else {
            $id = $user->id;
            $posts = DB::table('posts')
                ->join('users', 'posts.author_id', '=', 'users.id')
                ->where('posts.author_id', $id)
                ->get();
        }
        return response()->json([
            'posts' => $posts
        ], 201);

    }
}
