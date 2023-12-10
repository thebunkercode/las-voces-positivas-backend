<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function list(){
        return response()->json([
            'success' => true,
            'rows' => Post::all()
        ]);
    }
}
