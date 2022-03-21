<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminContoller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        $posts = DB::table('posts')
            ->join('users', 'posts.author_id', '=', 'users.id')
            ->get();
        return view('admin', compact('posts'));
    }
}
