<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function list(Request $request){
        if($request->has('with')){
            $posts = Post::with('user')->with('comments.user')->get();
        }else{
            $posts = Post::with('user')->get();
        }
        return response()->json([
            'success' => true,
            'rows' => $posts 
        ]);
    }
}
